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
            'codpes' => 5166999,
            'nome' => 'Breno Aparecido Servidone Moreno', 
            'regimento' => 'Antigo',
            'orientador_votante' => 'Sim',
            'sexo' => 'Masculino',
            'nivel' => 'Doutorado',
            'titulo' => 'Manuel Bandeira',
            'area_programa' => '8142',
            'data_horario' => '2020-11-30 12:00:00',
            'sala' => 'Sala da Direção',
            'orientador' => factory(App\Docente::class, 1)->create()[0]['n_usp']
        ];
        Agendamento::create($agendamento);
        //factory(Agendamento::class, 100)->create();
        factory(Agendamento::class, 10)->create()->each(function ($agendamento) {           
            $bancas = factory(App\Banca::class, 5)->make();
            $agendamento->bancas()->saveMany($bancas);
        });
    }
}
