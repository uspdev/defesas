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
            'codpes' => '63943',
            'nome' => 'Augusto Massi',
            'presidente' => 'Sim',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor2 = [
            'codpes' => '92762',
            'nome' => 'Leonardo Gomes Mello e Silva',
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];

        $professor3 = [
            'codpes' => '5511103',
            'nome' => 'Gabriel Antunes de Araujo',
            'presidente' => 'Não',
            'tipo' => 'Titular',
            'agendamento_id' => 1,
        ];
        Banca::create($professor1);
        Banca::create($professor2);
        Banca::create($professor3);
    }
}
