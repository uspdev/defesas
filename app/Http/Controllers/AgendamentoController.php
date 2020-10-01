<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Banca;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;

class AgendamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
        $query = Agendamento::orderBy('data_horario', 'asc');
        if($request->filtro_busca == 'numero_nome') {
            $query->where('codpes', '=', $request->busca)->orderBy('data_horario', 'asc');
            if($query->count() == null){
                $query->orWhere('nome', 'LIKE', "%$request->busca%");
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        $agendamento = new Agendamento;
        return view('agendamentos.create')->with('agendamento', $agendamento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendamentoRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        if($validated['nome'] == ''){
            $validated['nome'] = Pessoa::dump($validated['codpes'])['nompes'];
        }
        $agendamento = Agendamento::create($validated);
        //Salva o orientador na banca
        $banca = new Banca;
        $banca->codpes = $validated['orientador'];
        $banca->presidente = 'Sim'; 
        $banca->tipo = 'Titular'; 
        $banca->agendamento_id = $agendamento->id;
        $agendamento->bancas()->save($banca);
        return redirect("/agendamentos/$agendamento->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function show(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->setDataHorario($agendamento);
        $bancas = Banca::where('agendamento_id',$agendamento->id)->orderBy('tipo','desc')->get();
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        return view('agendamentos.show', compact(['agendamento','bancas']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->setDataHorario($agendamento);
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agendamento $agendamento)
    {
        $this->authorize('admin');
        $agendamento->bancas()->delete();
        $agendamento->delete();
        return redirect('/agendamentos');
    }

    
}
