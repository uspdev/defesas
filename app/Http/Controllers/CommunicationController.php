<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\CommunicationRequest;
use App\Models\Agendamento;
use App\Models\Communication;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AgendamentoRequest;

class CommunicationController extends Controller
{
    public function index(){
        Gate::authorize('comunicacao');
        //$comunicacao = Agendamento::where('status',1)->get();

        $agendamentos = Communication::rightJoin('agendamentos','agendamentos.id','communications.agendamento_id')
        ->where('agendamentos.status',1)
        ->orderBy('data_horario','desc')
        ->get();

        return view('comunicacao.index', ['agendamentos' => $agendamentos]);
    }

    public function show(Agendamento $comunicacao){
        Gate::authorize('comunicacao');
        return view('comunicacao.show', ['comunicacao' => $comunicacao]);
    }
    public function store(Request $request, Agendamento $agendamento){
        Gate::authorize('comunicacao');
        $comunicacao = new Communication;
        $comunicacao->nome = Auth::user()->name;
        $comunicacao->codpes = Auth::user()->codpes;
        $comunicacao->agendamento_id = $request->agendamento_id;
        $comunicacao->save();
        request()->session()->flash('alert-success','Defesa divulgada');
        return redirect('/comunicacao');
    }

}
