<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use App\Services\ReplicadoService;
use Carbon\Carbon;

class DadosDefesasAction
{
    public static function handle($agendamentos): Collection {
        $defesas = $agendamentos->map(function ($item) {
            return [
                'id' => $item->id,
                'aluno' => ReplicadoService::getNome($item->codpes),
                'trabalho' => ReplicadoService::getTituloTrabalho($item->codpes, $item->codare, $item->numseqpgm),
                'data_horario' => Carbon::parse($item->data_horario)->format('d/m/Y H:i'),
                'nivpgm' => $item->nivpgm,
                'area' => ReplicadoService::getNomeArea($item->codare),
                'orientador' => ReplicadoService::getOrientador($item->codpes, $item->codare, $item->numseqpgm),
                'local' => $item->sala,
            ];
        });

        return $defesas;
    }
}
