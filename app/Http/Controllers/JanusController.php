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

    public function store(JanusRequest $request, AgendamentoService $agendamentoService){
        $this->authorize('admin');
        $alunoPos = ReplicadoService::getAlunoPos($request->codpes);
        if($alunoPos) {
            $agendamento = $agendamentoService->newAgendamento($request->validated(), $alunoPos);
            return redirect("/agendamentos/$agendamento->id");
        }

        return back()->with('alert-danger','Aluno não encontrado ou Defesa não consolidada no Janus!');
    }

}
