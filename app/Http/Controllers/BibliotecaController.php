<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;

class BibliotecaController extends Controller
{
    
    public function index(Request $request)
    {
        $this->authorize('biblioteca');
        $query = Agendamento::where('status', 0)->orderBy('data_horario', 'asc');
        
        $agendamentos = $query->paginate(20);
        
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('biblioteca.index')->with('agendamentos',$agendamentos);
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
