<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\ReplicadoUtils;
use App\Models\Biblioteca;
use App\Services\ReplicadoService;

class BibliotecaController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('biblioteca');

        $agendamentos = Biblioteca::returnSchedules($request);
        $nomes = $this->nomes($agendamentos);

        $action = '/teses';

        return view('biblioteca.index', compact(['agendamentos', 'nomes', 'action']));
    }

    public function published(Request $request)
    {
        $this->authorize('biblioteca');

        $agendamentos = Biblioteca::returnSchedules($request, 1);
        $nomes = $this->nomes($agendamentos);
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

    public function nomes($agendamentos) {
        if ($agendamentos->count() > 0) {
            $codpes = $agendamentos->map(function ($item) {
                return $item['codpes'];
            })->implode(',');
            $nomes = collect(ReplicadoService::getNomes($codpes))->mapWithKeys(function (array $item) {
                return [
                    $item['codpes'] => $item['nompesttd']
                ];
            });
        }

        return $nomes ?? null;
    }
}
