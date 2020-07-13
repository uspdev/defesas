<?php

namespace App\Http\Controllers;

use App\Agendamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->busca != null) {
            $agendamentos = Agendamento::where('nome', 'LIKE', "%{$request->busca}%")->orderBy('data_horario', 'desc')->paginate(10);
        } else {
            $agendamentos = Agendamento::orderBy('data_horario', 'desc')->paginate(10);
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
    public function store(Request $request)
    {
        $agendamento = new Agendamento;
        $agendamento->codpes = $request->codpes;
        $agendamento->regimento = $request->regimento;
        $agendamento->orientador_votante = $request->orientador_votante;
        $agendamento->sexo = $request->sexo;
        $agendamento->nivel = $request->nivel;
        $agendamento->titulo = $request->titulo;
        $agendamento->area_programa = $request->area_programa;
        $agendamento->sala = $request->sala;
        $agendamento->data_horario = Carbon::CreatefromFormat('d/m/Y H:i', "$request->data $request->horario");
        $agendamento->orientador = $request->orientador;
        $agendamento->save();
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
        $data = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
        $horario = Carbon::parse($agendamento->data_horario)->format('H:i:s');
        $agendamento->data = $data;
        $agendamento->horario = $horario;
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
        $data = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
        $horario = Carbon::parse($agendamento->data_horario)->format('H:i:s');
        $agendamento->data = $data;
        $agendamento->horario = $horario;
        return view('agendamentos.edit')->with('agendamento', $agendamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agendamento  $agendamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        $agendamento->codpes = $request->codpes;
        $agendamento->regimento = $request->regimento;
        $agendamento->orientador_votante = $request->orientador_votante;
        $agendamento->sexo = $request->sexo;
        $agendamento->nivel = $request->nivel;
        $agendamento->titulo = $request->titulo;
        $agendamento->area_programa = $request->area_programa;
        $agendamento->data_horario = Carbon::CreatefromFormat('d/m/Y H:i:s', "$request->data $request->horario");
        $agendamento->sala = $request->sala;
        $agendamento->orientador = $request->orientador;
        $agendamento->save();
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
        $agendamento->delete();
        return redirect('/');
    }
}
