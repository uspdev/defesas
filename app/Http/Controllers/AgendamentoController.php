<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Banca;
use Illuminate\Http\Request;
use App\Http\Requests\AgendamentoRequest;

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
        if ($request->busca != null) {
            $agendamentos = Agendamento::where('codpes', '=', $request->busca)->orderBy('data_horario', 'desc')->paginate(20);
        } else {
            $agendamentos = Agendamento::orderBy('data_horario', 'desc')->paginate(20);
        }
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
        $validated = $request->validated();
        $agendamento = Agendamento::create($validated);
        if($validated['orientador_votante'] == 'Sim'){
            $banca = new Banca;
            $banca->codpes = $validated['orientador'];
            $banca->presidente = 'Não'; 
            $banca->agendamento_id = $agendamento->id;
            $agendamento->bancas()->save($banca);
        }
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
        $agendamento->setDataHorario($agendamento);
        return view('agendamentos.show')->with('agendamento', $agendamento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Agendamento $agendamento)
    {
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
        $validated = $request->validated();
        if($validated['orientador_votante'] == 'Não'){
            $banca = Banca::where('codpes',$validated['orientador'])->where('agendamento_id',$agendamento->id);
            $banca->delete();
        }
        elseif($validated['orientador_votante'] == 'Sim'){
            $banca = new Banca;
            $banca->codpes = $validated['orientador'];
            $banca->presidente = 'Não'; 
            $banca->agendamento_id = $agendamento->id;
            $agendamento->bancas()->save($banca);
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
        $agendamento->bancas()->delete();
        $agendamento->delete();
        return redirect('/');
    }
}
