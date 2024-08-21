<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banca;
use App\Models\Docente;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

class ApprovalStatusDefesaController extends Controller
{
    public function show(Agendamento $agendamento){
        $agendamento = Agendamento::join('docentes', 'docentes.n_usp', '=', 'agendamentos.orientador')
        ->select('agendamentos.*','docentes.nome as nome_doc')
        ->where('agendamentos.id',$agendamento->id)
        ->first();
        return view('status.index', compact('agendamento'));
    }

    public function aprovar(Request $request, Agendamento $agendamento){
        $agendamento = Agendamento::join('docentes', 'docentes.n_usp', '=', 'agendamentos.orientador')
        ->select('agendamentos.*','docentes.nome')
        ->where('agendamentos.id',$agendamento->id)->first();
        $agendamento->status = 1;
        $agendamento->data_publicacao = now();
        $agendamento->save();
        return redirect("/status/$agendamento->id");
    }

    public function reprovar(Request $request, Agendamento $agendamento){
        $agendamento = Agendamento::join('docentes', 'docentes.n_usp', '=', 'agendamentos.orientador')
        ->select('agendamentos.*','docentes.nome')
        ->where('agendamentos.id',$agendamento->id)->first();
        $agendamento->status = 0;
        $agendamento->save();
        return redirect("/status/$agendamento->id");
    }

}
