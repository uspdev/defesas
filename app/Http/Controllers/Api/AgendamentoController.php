<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use App\Services\ReplicadoService;

class AgendamentoController extends Controller
{
    public function index(){
        $agendamentos = Agendamento::where('data_horario', '>=', now())->toBase()->get();

        $agendamentos = $agendamentos->map(function ($item) {
            $titulo = ReplicadoService::getTituloTrabalho($item->codpes, $item->codare, $item->numseqpgm);

            return [
                'id' => $item->id,
                'orientador' => ReplicadoService::getOrientador($item->codpes, $item->codare, $item->numseqpgm)['nompesttd'],
                'titulo' => $titulo['tittrb'],
                'title' => $titulo['tittrbigl'],
                'data_horario' => $item->data_horario,
                'nome' => ReplicadoService::getNome($item->codpes),
                'nivel' => $item->nivpgm === 'ME' ? 'Mestrado' : 'Doutorado',
                'area_programa' => $item->codare,
                'programa' => ReplicadoService::getNomeArea($item->codare)['nomare']
            ];
        });

        return response()->json($agendamentos);
    }
}
