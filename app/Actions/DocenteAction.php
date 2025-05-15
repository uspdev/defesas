<?php

namespace App\Actions;

use App\Services\ReplicadoService;
use Illuminate\Support\Collection;

class DocenteAction
{
    /**
     * Retorna dados do docente
     */
    public static function handle(Collection $banca, int $codpes)
    {
        $docente = $banca->filter(function ($item) use ($codpes) {
            return $item['codpesdct'] == $codpes;
        })->map(function ($item) {

            $data['endereco'] = ReplicadoService::getEndereco($item['codpesdct']);
            $data['email'] = ReplicadoService::getEmail($item['codpesdct']);
            $data['telefones'] = ReplicadoService::getTelefones($item['codpesdct']);

            /* $data = QueriesAction::handle($item); */
            $data['documentos'] = ReplicadoService::getDocumentos($item['codpesdct'], ['numdocidf', 'numcpf']);
            if ($item['vinptpbantrb'] === 'SUP') {
                $data['tipvin'] = ReplicadoService::getVinculo($item['codpesdct']);
                $data['setor'] = ReplicadoService::getNomeSetor($item['codpesdct'], $data['tipvin']);
            }

            return array_merge($item, $data);
        });

        return $docente->collapseWithKeys();
    }
}
