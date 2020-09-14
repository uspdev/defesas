<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agendamento;

class indexController extends Controller
{
    public function index(Request $request){
        if($request->busca != '') {
            $agendamentos = Agendamento::where('area_programa', '=', $request->busca)->where('data_horario','>=',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc')->paginate(20);
        } 
        else{
            $agendamentos = Agendamento::where('data_horario','>=',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc')->paginate(20);
        }
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index')->with('agendamentos',$agendamentos);
    }

    public function anteriores(Request $request){
        if($request->busca != '') {
            $agendamentos = Agendamento::where('area_programa', '=', $request->busca)->where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'desc')->paginate(20);
        } 
        else{
            $agendamentos = Agendamento::where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'desc')->paginate(20);
        }
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('anteriores')->with('agendamentos',$agendamentos);
    }
}
