<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class TitularesAction
{
    public static function handle(array $banca)
    {
        $titulares = collect($banca)->filter(function ($item) {
            return $item['vinptpbantrb'] != 'SUP';
        })->map(function ($item) {
            $data = ReplicadoService::getDataTitulares($item['codpesdct']);
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            return array_merge($item, $data);
        });
        dd($titulares);

        return $titulares;
    }
}
