<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use App\Http\Requests\JanusRequest;
use App\Services\AgendamentoService;
use App\Services\ReplicadoService;

class JanusController extends Controller
{
    public function create(Agendamento $agendamento){
        $this->authorize('admin');
        return view('agendamentos.janus.create', compact('agendamento'));
    }

    public function store(JanusRequest $request){
        $this->authorize('admin');
        $alunoPos = ReplicadoService::getAlunoPos($request->codpes);
        dump($alunoPos);
        if($alunoPos) {
            dump(ReplicadoService::getOrientador($alunoPos['codpes'], $alunoPos['codare'], $alunoPos['numseqpgm']));
            dump(ReplicadoService::getNomeArea($alunoPos['codare']));
            dump(ReplicadoService::getTrabalho($alunoPos['codpes'], $alunoPos['dtadpopgm']));
            dd(ReplicadoService::getBanca($alunoPos['codpes'], $alunoPos['codare'], $alunoPos['numseqpgm']));
#            $agendamento = $agendamentoService->newAgendamento($request->validated(), $alunoPos);
#            return redirect("/agendamentos/$agendamento->id");
        }

#        $dadosJanus = ReplicadoUtils::retornarDadosJanus($request->codpes);
#        if($dadosJanus){
#            $agendamento = $agendamentoService->newAgendamento($request->validated(), $dadosJanus);
#            $agendamentoService->newBanca($agendamento, $dadosJanus['codpes'], $dadosJanus['numseqpgm']);
#
#            return redirect("/agendamentos/$agendamento->id");
#        }

        return back()->with('alert-danger','Aluno não encontrado ou Defesa não consolidada no Janus!');
    }

}
