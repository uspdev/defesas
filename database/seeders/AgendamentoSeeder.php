<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;

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
            'orientador' => Docente::factory()->create()->n_usp,
        ];
        Agendamento::create($agendamento);
        
        Agendamento::factory(10)->create()->each(function ($agendamento) {           
            $bancas = Banca::factory(5)->make();
            $agendamento->bancas()->saveMany($bancas);
        });
    }
}
