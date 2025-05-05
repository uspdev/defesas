<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Banca;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReciboExternoMail;
use App\Mail\ProLaboreMail;
use App\Mail\PassagemMail;
use App\Mail\DadosProfExternoMail;
use App\Jobs\SendDailyMail;
use Storage;
use App\Actions\DadosJanusAction;
use App\Actions\DadosProfessorAction;
use App\Actions\MapCodpesNomeAction;
use App\Services\ReplicadoService;
use App\Services\AgendamentoService;

class AgendamentoController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('admin');

        if ($request->filtro_busca == 'codpes' && $request->filled('busca_codpes')) {
            $validated = $request->validate([
                'busca_codpes' => 'required|integer',
            ]);
            $agendamento = Agendamento::where('codpes', '=', $request->busca_codpes)->paginate(20);
            $nomes = MapCodpesNomeAction::handle(collect($agendamento->items()));
        }
        if ($request->filtro_busca == 'data' && $request->filled('busca_data')) {
            $validated = $request->validate([
                'busca_data' => 'required|date_format:d/m/Y',
            ]);
            $data = Carbon::CreatefromFormat('d/m/Y H:i', $validated['busca_data'] . " 00:00");
            $agendamento =  Agendamento::whereDate('data_horario', '=', $data)->paginate(20);
            $nomes = MapCodpesNomeAction::handle(collect($agendamento->items()));
        }

        return view('agendamentos.index', [
            'agendamentos' => $agendamento ?? [],
            'nomes' => $nomes ?? []
        ]);
    }

    public function create(Agendamento $agendamento){
        $this->authorize('admin');
        return view('agendamentos.create', compact('agendamento'));

        /* $this->authorize('admin'); */
        /* $agendamento = new Agendamento; */
        /* return view('agendamentos.create')->with('agendamento', $agendamento); */
    }

    public function store(AgendamentoRequest $request, AgendamentoService $agendamentoService){
    /* public function store(AgendamentoRequest $request) */
        $this->authorize('admin');
        $alunoPos = ReplicadoService::getAlunoPos($request->codpes);
        if($alunoPos) {
            $agendamento = $agendamentoService->newAgendamento($request->validated(), $alunoPos);
            return redirect("/agendamentos/$agendamento->id");
        }

        return back()->with('alert-danger','Aluno não encontrado ou Defesa não consolidada no Janus!');

        /* $this->authorize('admin'); */
        /* $validated = $request->validated(); */
        /* if($validated['nome'] == ''){ */
        /*     $validated['nome'] = Pessoa::dump($validated['codpes'])['nompes']; */
        /* } */
        /* $validated['nome_orientador'] = Pessoa::dump($validated['orientador'])['nompes']; */
        /* $agendamento = Agendamento::create($validated); */
        /* //Salva o orientador na banca */
        /* $banca = new Banca; */
        /* $banca->codpes = $validated['orientador']; */
        /* $banca->presidente = 'Sim'; */
        /* $banca->tipo = 'Titular'; */
        /* $banca->agendamento_id = $agendamento->id; */
        /* $agendamento->bancas()->save($banca); */
        /* //Salva o co-orientador na banca */
        /* if($validated['co_orientador']){ */
        /*     $validated['nome_co_orientador'] = Pessoa::dump($validated['co_orientador'])['nompes']; */
        /*     $banca = new Banca; */
        /*     $banca->codpes = $validated['co_orientador']; */
        /*     $banca->presidente = 'Não'; */
        /*     $banca->tipo = 'Titular'; */
        /*     $banca->agendamento_id = $agendamento->id; */
        /*     $agendamento->bancas()->save($banca); */
        /* } */
        /**/
        /* return redirect("/agendamentos/$agendamento->id"); */
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
        $dados = $request->all(); //tratado como array agora.
        /* evitando o erro "Serialization of 'Closure' is not allowed" que dá ao trocar o método send pelo queue.
*/
        Mail::queue(new ReciboExternoMail($agendamento, $docente, $dados));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailProLabore(Agendamento $agendamento, Docente $docente){
        $this->authorize('admin');
        Mail::queue(new ProLaboreMail($agendamento, $docente));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function pendencia(Request $request){
        $this->authorize('admin');

        $query = Agendamento::with('docente')
            ->whereNull('sala_virtual')
            ->whereDate('data_horario', '>=', now())
            ->orderBy('data_horario');

        $query->when(!$request->busca, function ($query) {
            return $query->where('tipo', '=', 'Virtual');
        });

        $query->when($request->busca, function ($query) use ($request) {
            return $query->where('codpes', $request->busca)
               ->orWhere('orientador', $request->busca)
               ->where('tipo','=', 'Virtual')
               ->whereNull('sala_virtual');
        });

        return view('agendamentos.recibos.defesa')->with([
            'agendamentos' => $query->get(),
        ]);
    }

    public function enviarEmailPassagem(Agendamento $agendamento, Banca $banca){
        $this->authorize('admin');
        $docente = Docente::where('n_usp',$banca->codpes)->first();
        $emails = Pessoa::emails($docente->n_usp);
        foreach($emails as $email){
            if($email != '') Mail::queue(new PassagemMail($agendamento, $docente, $email));
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailDeConfirmacaoDadosProfExterno(Agendamento $agendamento, Banca $banca){
        $this->authorize('admin');
        $docente = Docente::where('n_usp',$banca->codpes)->first();
        $emails = Pessoa::emails($docente->n_usp);
        foreach($emails as $email){
            if($email != '') Mail::queue(new DadosProfExternoMail($docente, $email));;
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    /*Api para entregar nome do(a) aluno(a) no blade */
    public function info(Request $request){
        if(empty($request->codpes)){
            return response('Pessoa não encontrada');
        }

        if(!is_int((int)$request->codpes)){
            return response('Pessoa não encontrada');
        }

        if(strlen($request->codpes) < 6){
            return response('Pessoa não encontrada');
        }

        $info = Pessoa::nomeCompleto($request->codpes);
        if($info){
            $infos['nome'] = Pessoa::nomeCompleto($request->codpes);
            $infos['sexo'] = Pessoa::dump($request->codpes)['sexpes'];
            return response($infos);
        }
        else{
            return response('Pessoa não encontrada');
        }
    }

    public function job_email_prof(Agendamento $agendamento, Docente $docente){
        $this->authorize('admin');
        $daily = SendDailyMail::dispatch_sync();
        return 'Emails Enviados com sucesso';
    }

}
