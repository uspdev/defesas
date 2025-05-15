<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class QueriesAction
{
    /**
     * Retorna dados dos docentes
     */
    public static function handle(array $item)
    {
        $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
        if ($data['tipvin'] === 'EXTERNO') {
            $data['endereco'] = ReplicadoService::getEndereco($item['codpesdct']);
        };
        $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
        $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);
        $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

        return $data;
    }

}
