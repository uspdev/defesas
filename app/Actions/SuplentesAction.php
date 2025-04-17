<?php

namespace App\Actions;

#use App\Services\ReplicadoService;

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
            $data = QueriesAction::handle($item);

            return array_merge($item, $data);
        });

        return $suplentes;
    }
}
