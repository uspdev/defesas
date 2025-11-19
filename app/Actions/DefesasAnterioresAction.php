<?php

namespace App\Actions;

use App\Models\Agendamento;
use App\Services\ReplicadoService;

class DefesasAnterioresAction
{

    public static function handle(array $validated)
    {

        $query = Agendamento::query()
            ->where('data_horario', '<', now())
            ->orderBy('data_horario', 'desc')
            ->toBase();

        $query->when(isset($validated['programa']), function ($q) use ($validated) {
            return $q->where('codare', '=', $validated['programa']);
        });

        $query->when(isset($validated['nivel']), function ($q) use ($validated) {
            $conditional = $validated['nivel'] === 'Mestrado' ? '=' : '<>';
            return $q->where('nivpgm', $conditional, 'ME');
        });

        $query->when(isset($validated['candidato']), function ($q) use ($validated) {
            $pessoas = ReplicadoService::getPorNome($validated['candidato']);
            $codpes = collect($pessoas)->pluck('codpes');
            return $q->whereIn('codpes', $codpes);
        });

        return $query;

    }

}
