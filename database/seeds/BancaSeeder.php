<?php

use Illuminate\Database\Seeder;
use App\Banca;

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
            'codpes' => factory(App\Docente::class, 1)->create()[0]['n_usp'],
            'presidente' => 'Sim',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor2 = [
            'codpes' => factory(App\Docente::class, 1)->create()[0]['n_usp'],
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor3 = [
            'codpes' => factory(App\Docente::class, 1)->create()[0]['n_usp'],
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];
        Banca::create($professor1);
        Banca::create($professor2);
        Banca::create($professor3);
    }
}
