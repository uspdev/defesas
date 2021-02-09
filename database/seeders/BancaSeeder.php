<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banca;
use App\Models\Docente;

class BancaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professor1 = [
            'codpes' => Docente::factory()->create()->n_usp,
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor2 = [
            'codpes' => Docente::factory()->create()->n_usp,
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor3 = [
            'codpes' => Docente::factory()->create()->n_usp,
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];
        Banca::create($professor1);
        Banca::create($professor2);
        Banca::create($professor3);
    }
}
