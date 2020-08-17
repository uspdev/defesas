<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agendamento;

class indexController extends Controller
{
    public function index(){
        $agendamentos = Agendamento::whereDate('data_horario','>=',date('Y-m-d'))->get();
        return view('index')->with('agendamentos',$agendamentos);
    }
}
