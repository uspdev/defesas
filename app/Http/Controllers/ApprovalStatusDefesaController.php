<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Http\Requests\ApprovalStatusRequest;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;

class ApprovalStatusDefesaController extends Controller
{
    public function show(Request $request, Agendamento $agendamento){
        $this->authorize('admin');
        return view('create_status')->with([
            'agendamento' => $agendamento,
        ]);
    }

    public function update(ApprovalStatusRequest $request, Agendamento $agendamento){
        $this->authorize('admin');
        $agendamento->fill($request->validated());
        $agendamento->save();
        return redirect('anteriores');
    }
}
