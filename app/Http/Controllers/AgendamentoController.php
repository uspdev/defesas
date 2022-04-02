<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Banca;
use App\Models\Docente;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReciboExternoMail;
use App\Mail\ProLaboreMail;
use App\Mail\PassagemMail;
use App\Mail\DadosProfExternoMail;

class AgendamentoController extends Controller
{
    
    public function index(Request $request)
    {
        $this->authorize('admin');
        $query = Agendamento::orderBy('data_horario', 'asc');
        $query2 = Docente::orderBy('nome', 'asc');
        if($request->filtro_busca == 'numero_nome') {
            $query->where('codpes', '=', $request->busca)->orderBy('data_horario', 'asc');
            if($query->count() == null){
                $query->orWhere('nome', 'LIKE', "%$request->busca%");
            }
            $query2->where('nome', 'LIKE', "%$request->busca%");
            foreach($query2->get() as $orientador){
                $query->orWhere('orientador', '=', $orientador->n_usp);
            }
        } 
        elseif($request->filtro_busca == 'data'){
            $validated = $request->validate([
                'busca_data' => 'required|data',
            ]);        
            $data = Carbon::CreatefromFormat('d/m/Y H:i', $validated['busca_data']." 00:00");
            $query->whereDate('data_horario','=', $data);
        }
        else{
            $query->where('data_horario','>=',date('Y-m-d H:i:s'));
        }
        $agendamentos = $query->paginate(20);
        
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('agendamentos.index')->with('agendamentos',$agendamentos);
    }

    public function create()
    {
        $this->authorize('admin');
        $agendamento = new Agendamento;
        return view('agendamentos.create')->with('agendamento', $agendamento);
    }

    public function store(AgendamentoRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        if($validated['nome'] == ''){
            $validated['nome'] = Pessoa::dump($validated['codpes'])['nompes'];
        }
        $validated['nome_orientador'] = Pessoa::dump($validated['orientador'])['nompes'];
        $agendamento = Agendamento::create($validated);
        //Salva o orientador na banca
        $banca = new Banca;
        $banca->codpes = $validated['orientador'];
        $banca->presidente = 'Sim'; 
        $banca->tipo = 'Titular'; 
        $banca->agendamento_id = $agendamento->id;
        $agendamento->bancas()->save($banca);
        //Salva o co-orientador na banca
        if($validated['co_orientador']){
            $validated['nome_co_orientador'] = Pessoa::dump($validated['co_orientador'])['nompes'];
            $banca = new Banca;
            $banca->codpes = $validated['co_orientador'];
            $banca->presidente = 'Não'; 
            $banca->tipo = 'Titular'; 
            $banca->agendamento_id = $agendamento->id;
            $agendamento->bancas()->save($banca);
        }
        
        return redirect("/agendamentos/$agendamento->id");
    }

    public function show(Agendamento $agendamento)
    {
        //$this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        $dadosJanus = ReplicadoUtils::retornarDadosJanus($agendamento->codpes);
        return view('agendamentos.show', compact(['agendamento','dadosJanus']));
    }

    public function edit(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    public function update(AgendamentoRequest $request, Agendamento $agendamento)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        if($validated['nome'] == ''){
            $validated['nome'] = Pessoa::dump($validated['codpes'])['nompes'];
        }
        $agendamento->update($validated);
        return redirect("/agendamentos/$agendamento->id");
    }

    public function destroy(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->bancas()->delete();
        $agendamento->delete();
        return redirect('/agendamentos');
    }

    public function enviarEmailReciboExterno(Agendamento $agendamento, Docente $docente, Request $request){
        $this->authorize('admin');
        Mail::send(new ReciboExternoMail($agendamento, $docente, $request));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailProLabore(Agendamento $agendamento, Docente $docente){
        $this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        Mail::send(new ProLaboreMail($agendamento, $docente));
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailPassagem(Agendamento $agendamento, Banca $banca){
        $this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        $docente = Docente::where('n_usp',$banca->codpes)->first();
        $emails = explode(" /", $docente->email);
        foreach($emails as $email){
            if($email != '') Mail::send(new PassagemMail($agendamento, $docente, $email));
        }
        return redirect('/agendamentos/'.$agendamento->id);
    }

    public function enviarEmailDeConfirmacaoDadosProfExterno(Agendamento $agendamento, Banca $banca){
        $this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        $docente = Docente::where('n_usp',$banca->codpes)->first();
        $emails = explode(" /", $docente->email);
        foreach($emails as $email){
            if($email != '') Mail::send(new DadosProfExternoMail($docente, $email));;
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

    
}
