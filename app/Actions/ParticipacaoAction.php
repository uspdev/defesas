<?php

namespace App\Actions;

use App\Services\ReplicadoService;
use App\Models\Agendamento;
use Carbon\Carbon;

class ParticipacaoAction
{
    public static function handle($banca)
    {
        if ( !empty($banca) ) {
            $participacao = collect($banca)->map(function ($item) {
                $agendamento = Agendamento::where([
                    'codare' => $item['codare'],
                    'numseqpgm' => $item['numseqpgm'],
                    'codpes' => $item['codpes']
                ])->get();
                if ( $agendamento->isNotEmpty() ) {
                    $agendamento = $agendamento->first();
                    $data['codare'] = $item['codare'];
                    $data['area'] = ReplicadoService::getNomeArea($item['codare']);
                    $data['aluno'] = ReplicadoService::getNome($item['codpes']);
                    $data['titulo'] = ReplicadoService::getTituloTrabalho($item['codpes'],$item['codare'],$item['numseqpgm']);
                    $data['id'] = $agendamento->id;
                    $data['nivpgm'] = $agendamento->nivpgm;
                    $data['data'] = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
                    $data['orientador'] = ReplicadoService::getOrientador($item['codpes'], $item['codare'], $item['numseqpgm']);

                }
                return $data ?? [];
            })->filter();
        }

        return $participacao ?? null;
    }
}
