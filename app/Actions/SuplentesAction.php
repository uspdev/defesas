<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class SuplentesAction
{
    public static function handle(array $banca)
    {
        $suplentes = collect($banca)->filter(function ($item) {
            return $item['vinptpbantrb'] == 'SUP';
        })->map(function ($item) {
            $data = ReplicadoService::getEndereco($item['codpesdct']);
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
            $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);
            $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

            return array_merge($item, $data);
        });

        return $suplentes;
    }
}
