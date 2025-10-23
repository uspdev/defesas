<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReciboExternoMail;
use App\Mail\ProLaboreMail;
use App\Mail\PassagemMail;
use App\Mail\DadosProfExternoMail;
use App\Jobs\SendDailyMail;
use Illuminate\Support\Facades\Storage;
use App\Actions\DadosJanusAction;
use App\Actions\DadosProfessorAction;
use App\Actions\MapCodpesNomeAction;
use App\Actions\DocenteAction;
use App\Services\ReplicadoService;
use App\Services\AgendamentoService;
use App\Http\Requests\AgendamentoSearchRequest;

class AgendamentoController extends Controller
{

    public function index()
    {
        $this->authorize('admin');

        return view('agendamentos.index', [
            'agendamentos' => [],
            'nomes' => [],
            'filtro' => 'nome'
        ]);
    }

    public function search (AgendamentoSearchRequest $request) {
        $this->authorize('admin');

        $query = Agendamento::query();

        $query->when($request->validated('filtro') == 'nome', function ($query)  use ($request) {
            $pessoas = ReplicadoService::getPorCodigoOuNome($request->validated('nome'));
            $codpes = collect($pessoas)->pluck('codpes');
            return $query->whereIn('codpes', $codpes);
        });
        $query->when($request->validated('filtro') == 'codpes', function ($query)  use ($request) {
            return $query->where('codpes', '=', $request->validated('codpes'));
        });
        $query->when($request->validated('filtro') == 'data', function ($query)  use ($request) {
            $data = Carbon::CreatefromFormat('d/m/Y H:i', $request->validated('data') . " 00:00");
            return $query->whereDate('data_horario', '=', $data);
        });

        $agendamentos = $query->paginate(20);
        $nomes = MapCodpesNomeAction::handle(collect($agendamentos->items()));

        return view('agendamentos.index', [
            'agendamentos' => $agendamentos ?? [],
            'nomes' => $nomes ?? [],
            'filtro' => $request->validated('filtro')
        ]);

    }

    public function create(Agendamento $agendamento){
        $this->authorize('admin');

        return view('agendamentos.create', compact('agendamento'));
    }

    public function store(AgendamentoRequest $request, AgendamentoService $agendamentoService){
        $this->authorize('admin');
        $alunoPos = ReplicadoService::getAlunoPos($request->codpes);
        if($alunoPos) {
            $agendamento = $agendamentoService->newAgendamento($request->validated(), $alunoPos);
            return redirect("/agendamentos/$agendamento->id");
        }

        return back()->with('alert-danger','Aluno não encontrado ou Defesa não consolidada no Janus!');
    }

    public function show(Agendamento $agendamento)
    {
        $this->authorize('biblioteca');
        $agendamento = DadosJanusAction::handle($agendamento);

        return view('agendamentos.show', compact(['agendamento']));
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);

        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->update($request->validated());

        return redirect("/agendamentos/$agendamento->id");
    }

    public function destroy(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->bancas()->delete();
        foreach($agendamento->files as $file){
            Storage::delete($file->path);
            $file->delete();
        }
        $agendamento->delete();
        return redirect('/agendamentos');
    }

    public function enviarEmailReciboExterno(Agendamento $agendamento, $codpes, Request $request){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $docente = DadosProfessorAction::handle($agendamento->banca, $codpes);
        $dados = $request->all();
        Mail::queue(new ReciboExternoMail($agendamento, $docente, $dados));

        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailProLabore(Agendamento $agendamento, int $codpes){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $docente = DocenteAction::handle(collect($agendamento->banca), $codpes);
        Mail::queue(new ProLaboreMail($agendamento, $docente));

        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function pendencia(Request $request){
        $this->authorize('admin');

        $query = Agendamento::with('docente')
            ->whereNull('sala_virtual')
            ->whereDate('data_horario', '>=', now())
            ->where('tipo', '=', 'Virtual')
            ->orderBy('data_horario');

        $query->when($request->busca, function ($query) use ($request) {
            return $query->where('codpes', $request->busca)
               ->where('tipo','=','Virtual');
        });

        $agendamentos =  $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'codpes' => $item->codpes,
                'aluno' => ReplicadoService::getNome($item->codpes),
                'nivpgm' => $item->nivpgm,
                'trabalho' => ReplicadoService::getTituloTrabalho($item->codpes, $item->codare, $item->numseqpgm),
                'enviar_email' => $item->enviar_email,
                'data_horario' => $item->data_horario
            ];
        });

        return view('agendamentos.pendencia')->with([
            'agendamentos' => $agendamentos,
        ]);
    }

    public function enviarEmailPassagem(Agendamento $agendamento, int $codpes){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $docente = DocenteAction::handle(collect($agendamento->banca), $codpes);
        Mail::queue(new PassagemMail($agendamento, $docente));

        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailDeConfirmacaoDadosProfExterno(Agendamento $agendamento, int $codpes){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $docente = DocenteAction::handle(collect($agendamento->banca), $codpes);
        Mail::queue(new DadosProfExternoMail($docente));;

        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function job_email_prof(Agendamento $agendamento, Docente $docente){
        $this->authorize('admin');
        $daily = SendDailyMail::dispatch_sync();
        return 'Emails Enviados com sucesso';
    }

    public function emailsBanca(Agendamento $agendamento) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $emails = ReplicadoService::getEmailsBanca(collect($agendamento->banca));

        return response()->json($emails);
    }

}
