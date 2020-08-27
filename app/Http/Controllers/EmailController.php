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
    
    //Função que exibe apenas uma view com os dados a serem copiados e enviados via e-mail para a tesouraria. Automatização desse processo será realizada mais para frente.
    public function reciboExterno(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('admin');
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $agendamento->setNomeArea($agendamento);
        $configs = Config::orderbyDesc('created_at')->first();
        return view('agendamentos.recibos.recibo_externo', compact(['agendamento','banca','dados','configs']));
    }

    //Função que exibe apenas uma view com os dados a serem copiados e enviados via e-mail para o docente. Automatização desse processo será realizada mais para frente.
    public function emailDocente(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('admin');
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $agendamento->setNomeArea($agendamento);
        $configs = Config::setConfigEmail($agendamento,$banca);
        return view('agendamentos.recibos.email', compact(['agendamento','banca','dados','configs']));
    }
}
