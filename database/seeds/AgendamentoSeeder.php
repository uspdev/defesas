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
            'codpes' => 10270025, 
            'regimento' => 'Antigo',
            'orientador_votante' => 'Sim',
            'sexo' => 'Masculino',
            'nivel' => 'Doutorado',
            'titulo' => 'Manuel Bandeira',
            'area_programa' => 'Teoria Literária e Literatura Comparada',
            'data_horario' => '1980-06-20 12:00:00',
            'sala' => 'Sala da Direção',
            'orientador' => '2202281',
        ];
        Agendamento::create($agendamento);
        //factory(Agendamento::class, 100)->create();
        factory(Agendamento::class, 10)->create()->each(function ($agendamento) {           
            $bancas = factory(App\Banca::class, 5)->make();
            $agendamento->bancas()->saveMany($bancas);
        });
    }
}
