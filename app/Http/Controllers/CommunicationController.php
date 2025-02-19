<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\CommunicationRequest;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use App\Models\Communication;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AgendamentoRequest;

class CommunicationController extends Controller
{
    public function index(){
        Gate::authorize('comunicacao');
        $agendamentos = Agendamento::where('status',1)
        ->orderBy('data_horario', 'desc')
        ->paginate(15);

        return view('comunicacao.index', ['agendamentos' => $agendamentos]);
    }

    public function show(Agendamento $agendamento){
        Gate::authorize('comunicacao');
        $dadosJanus = ReplicadoUtils::retornarDadosJanus($agendamento->codpes);
        return view('comunicacao.show', ['agendamento' => $agendamento, 'dadosJanus' => $dadosJanus]);
    }
}
