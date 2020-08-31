<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agendamento;

class indexController extends Controller
{
    public function index(){
        $agendamentos = Agendamento::where('data_horario','>=',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc')->paginate(20);
        return view('index')->with('agendamentos',$agendamentos);
    }

    public function anteriores(){
        $agendamentos = Agendamento::where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc')->paginate(20);
        return view('anteriores')->with('agendamentos',$agendamentos);
    }
}
