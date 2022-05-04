<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;
use App\Models\Biblioteca;

class BibliotecaController extends Controller
{
    
    public function index(Request $request)
    {
        $this->authorize('biblioteca');
        
        $agendamentos = Biblioteca::returnSchedules($request);

        $action = '/teses';

        return view('biblioteca.index', compact(['agendamentos', 'action']));
    }

    public function published(Request $request)
    {
        $this->authorize('biblioteca');

        $agendamentos = Biblioteca::returnSchedules($request, 1);

        $action = '/teses/publicadas';

        return view('biblioteca.index', compact(['agendamentos', 'action']));
    }

    public function show(Agendamento $agendamento)
    {
        $this->authorize('biblioteca');
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        return view('agendamentos.show', compact('agendamento'));
    }

    public function publish(Request $request, Agendamento $agendamento){
        $validated = $request->validate([
          'url' => 'required',
          'status' => 'required',
        ]);
        $agendamento->data_publicacao = date('Y-m-d');
        $agendamento->url = $validated['url'];
        $agendamento->status = $validated['status'];
        $agendamento->user_id_biblioteca = Auth::user()->id;
        $agendamento->save();
        
        $agendamento->formatDataHorario($agendamento);
        return redirect("/agendamentos/$agendamento->id");
    }
}
