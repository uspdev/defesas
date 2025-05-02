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
        $data = ReplicadoService::getEndereco($item['codpesdct']);
        $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
        $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
        $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);
        $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

        return $data;
    }

}
