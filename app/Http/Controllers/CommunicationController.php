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
    public function index(Request $request){
        Gate::authorize('comunicacao');
        
        $agendamentos = Agendamento::where('status',1)
        ->orderBy('data_publicacao','desc')
        ->where('data_publicacao',">=","$request->filtro_ano" . '-01-01 00:00:00')
        ->where('data_publicacao',"<=","$request->filtro_ano" . '-12-31 23:59:59'); // Não dá pra fazer group by com id...
        return view('comunicacao.index', ['agendamentos' => $agendamentos->paginate(15)]);
    }
    
    public function show(Agendamento $agendamento){
        Gate::authorize('comunicacao');
        $dadosJanus = ReplicadoUtils::retornarDadosComunicacao($agendamento->codpes);
        return view('comunicacao.show', ['agendamento' => $agendamento, 'dadosJanus' => $dadosJanus]);
    }
}
