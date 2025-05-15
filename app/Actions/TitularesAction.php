<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class TitularesAction
{
    /**
     * Retorna dados dos titulares da banca
     */
    public static function handle(array $banca)
    {
        $titulares = collect($banca)->filter(function ($item) {
            return $item['vinptpbantrb'] != 'SUP';
        })->map(function ($item) {
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

            return array_merge($item, $data);
        });

        return $titulares;
    }
}
