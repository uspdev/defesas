<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Http\Requests\Approval_statusRequest;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;

class StatusDefesaController extends Controller
{
    public function showDefesa(Request $request, Agendamento $agendamento){
        $this->authorize('admin');
    
        $agendamentos = Agendamento::where('id', $request->id);

        return view('create_status')->with([
            'agendamento' => $agendamento,
            'agendamentos' => $agendamentos
        ]);
    }

    public function statusDefesa(Approval_statusRequest $request, Agendamento $agendamento){
        $this->authorize('admin');
        $validated = $request->validate([
            'approval_status' => 'required',
          ]);
        $agendamento->approval_status = $request->approval_status;
        $agendamento->save();
        return redirect('anteriores');
    }
}
