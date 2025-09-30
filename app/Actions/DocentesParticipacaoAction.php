<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class DocentesParticipacaoAction
{
    /**
     * Retorna dados dos docentes que participarão da banca
     */
    public static function handle(array $banca)
    {
        $docentes = collect($banca)->filter(function ($item) {
            return $item['staptp'] === 'S';
        })->map(function ($item) {
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

            return array_merge($item, $data);
        });

        return $docentes;
    }
}
