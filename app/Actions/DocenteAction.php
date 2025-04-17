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
        })->map(function ($item) {
            $data = QueriesAction::handle($item);
            $data['documentos'] = ReplicadoService::getDocumentos($item['codpesdct'], ['numdocidf', 'numcpf']);

            return array_merge($item, $data);
        });

        return $docente->collapseWithKeys();
    }
}
