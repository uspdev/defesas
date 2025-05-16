<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use App\Services\ReplicadoService;

class EnderecoDocenteExternoAction
{
    public static function handle(Collection $professores): Collection
    {

        $data = $professores->filter(function ($item) {
            return $item['tipvin'] === 'EXTERNO';
        })->map(function ($item) {
            $data['endereco'] = ReplicadoService::getEndereco($item['codpesdct']);

            return array_merge($item, $data);
        });

        return $data;
    }
}
