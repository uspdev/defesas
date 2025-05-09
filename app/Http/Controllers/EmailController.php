<?php

namespace App\Http\Controllers;
use App\Models\Agendamento;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Actions\DadosJanusAction;
use App\Actions\DocenteAction;
use App\Actions\DadosProfessorAction;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Função que exibe apenas uma view com os dados a serem copiados e enviados via e-mail para a tesouraria. Automatização desse processo será realizada mais para frente.
    public function exibirReciboExterno(Agendamento $agendamento, $codpes, Request $request){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $dados = $request;
        $docente = DadosProfessorAction::handle($agendamento->banca, $codpes);
        $configs = Config::orderbyDesc('created_at')->first();
        return view('agendamentos.recibos.recibo_externo', compact(['agendamento','docente','dados','configs']));
    }

    //Função que exibe apenas uma view com os dados a serem copiados e enviados via e-mail para o docente. Automatização desse processo será realizada mais para frente.
    public function exibirEmailDocente(Agendamento $agendamento, $codpes, Request $request){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $dados = $request;
        $docente = DocenteAction::handle($agendamento->banca, $codpes);
        $configs = Config::setConfigEmail($agendamento, $docente);
        return view('agendamentos.recibos.email', compact(['agendamento','docente','dados','configs']));
    }

}
