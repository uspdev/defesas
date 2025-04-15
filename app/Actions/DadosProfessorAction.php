<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class DadosProfessorAction
{
    /**
     * Retorna dados do docente
     */
    public static function handle(array $banca, int $codpes)
    {
        $docente = collect($banca)->filter(function ($item) use ($codpes) {
            return $item['codpesdct'] == $codpes;
        })->map(function ($item) {
            $data['email'] = ReplicadoService::getEmail($item['codpesdct']);

            return array_merge($item, $data);
        });

        return $docente->collapseWithKeys();
    }
}
