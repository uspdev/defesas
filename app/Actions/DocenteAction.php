<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class DocenteAction
{
    /**
     * Retorna dados do docente
     */
    public static function handle(array $banca, int $codpes)
    {
        $docente = collect($banca)->filter(function ($item) use ($codpes) {
            return $item['codpesdct'] == $codpes;
        })->map(function ($item) use ($codpes) {
            $data = ReplicadoService::getEndereco($item['codpesdct']);
            $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
            $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
            $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);
            $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);

            return array_merge($item, $data);
        });

        return $docente->collapseWithKeys();
    }
}
