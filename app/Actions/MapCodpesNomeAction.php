<?php

namespace App\Actions;

use App\Services\ReplicadoService;
use Illuminate\Support\Collection;

class MapCodpesNomeAction
{
    /**
     * Retorna uma collection sendo o codpes como chave e o nome valor
     */
    public static function handle(Collection $agendamentos): Collection
    {
        if ($agendamentos->count() > 1) {
            $codpes = $agendamentos->map(function ($item) {
                return $item['codpes'];
            })->implode(',');
            $nomes = collect(ReplicadoService::getNomes($codpes))
                ->mapWithKeys(function (array $item) {
                    return [
                        $item['codpes'] => $item['nompesttd']
                    ];
            });
        }
        if ($agendamentos->count() == 1) {
            $nomes = $agendamentos->mapWithKeys(function ($item) {
                return [
                    $item['codpes'] => ReplicadoService::getNome($item['codpes'])
                ];
            });
        }

        return $nomes ?? collect([]);
    }

}
