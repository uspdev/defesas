<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use App\Http\Requests\JanusRequest;
use App\Services\AgendamentoService;

class JanusController extends Controller
{
    public function create(Agendamento $agendamento){
        $this->authorize('admin');
        return view('agendamentos.janus.create', compact('agendamento'));
    }

    public function store(JanusRequest $request, AgendamentoService $agendamentoService){
        $this->authorize('admin');
        $dadosJanus = ReplicadoUtils::retornarDadosJanus($request->codpes);
        if($dadosJanus){
            $agendamento = $agendamentoService->newAgendamento($request->validated(), $dadosJanus);
            $agendamentoService->newBanca($agendamento, $dadosJanus['codpes'], $dadosJanus['numseqpgm']);

            return redirect("/agendamentos/$agendamento->id");
        }

        return back()->with('alert-danger','Aluno não encontrado no Janus!');
    }

}
