<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biblioteca;
use App\Actions\MapCodpesNomeAction;

class BibliotecaController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('biblioteca');

        $agendamentos = Biblioteca::returnSchedules($request);
        $nomes = MapCodpesNomeAction::handle(collect($agendamentos->items()));

        $action = '/teses';

        return view('biblioteca.index', compact(['agendamentos', 'nomes', 'action']));
    }

    public function published(Request $request)
    {
        $this->authorize('biblioteca');

        $agendamentos = Biblioteca::returnSchedules($request, 1);
        $nomes = MapCodpesNomeAction::handle(collect($agendamentos->items()));
        $action = '/teses/publicadas';

        return view('biblioteca.index', compact(['agendamentos', 'nomes', 'action']));
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

        return redirect("/agendamentos/$agendamento->id");
    }

}
