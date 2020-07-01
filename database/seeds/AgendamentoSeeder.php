<?php

use Illuminate\Database\Seeder;
use App\Agendamento;

class AgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agendamento = [
            'nome'=> 'Davi Arrigucci',
            'codpes' => 777,
            'regimento' => 'Antigo',
            'orientador_votante' => 'Sim',
            'sexo' => 'Masculino',
            'nivel' => 'Doutorado',
            'titulo' => 'Manuel Bandeira',
            'area_programa' => '14',
            'data_horario' => '1980-06-20 12:00:00',
            'sala' => '10',
            'orientador' => 'Antonio Candido',
        ];
        Agendamento::create($agendamento);
        factory(Agendamento::class, 100)->create();
    }
}
