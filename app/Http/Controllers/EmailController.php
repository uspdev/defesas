<?php

namespace App\Http\Controllers;
use App\Agendamento;
use App\Banca;
use App\Config;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function reciboExterno(Agendamento $agendamento, Banca $banca, Request $request){
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $configs = Config::orderbyDesc('created_at')->first();
        return view('agendamentos.recibos.recibo_externo', compact(['agendamento','banca','dados','configs']));
    }

    public function emailDocente(Agendamento $agendamento, Banca $banca, Request $request){
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $configs = Config::setConfigEmail($agendamento,$banca);
        return view('agendamentos.recibos.email', compact(['agendamento','banca','dados','configs']));
    }
}
