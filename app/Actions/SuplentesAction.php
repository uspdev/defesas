<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class SuplentesAction
{
    /**
     * Retorna dados dos suplentes da banca
     */
    public static function handle(array $banca)
    {
        $suplentes = collect($banca)->filter(function ($item) {
            return $item['vinptpbantrb'] == 'SUP';
        })->map(function ($item) {
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            if ($data['tipvin'] === 'EXTERNO') {
                $data['endereco'] = ReplicadoService::getEndereco($item['codpesdct']);
            };
            $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
            $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);
            $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

            return array_merge($item, $data);
        });

        return $suplentes;
    }
}
