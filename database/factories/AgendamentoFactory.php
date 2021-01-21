<?php

namespace Database\Factories;

use App\Models\Agendamento;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Docente;
use Uspdev\Replicado\Pessoa;

class AgendamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agendamento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sexo = Agendamento::sexoOptions(); 
        $regimento = Agendamento::regimentoOptions(); 
        $nivel = Agendamento::nivelOptions(); 
        $area_programa = Agendamento::programaOptions();
        $aluno = $this->faker->unique()->posgraduacao();
        $orientador = Docente::factory()->create()->n_usp;
        return [
            'codpes' => $aluno,
            'nome' => Pessoa::dump($aluno)['nompes'],
            'regimento' => $regimento[array_rand($regimento)],
            'orientador_votante' => 'Não',
            'sexo' => $sexo[array_rand($sexo)],
            'nivel' => $nivel[array_rand($nivel)],
            'titulo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'area_programa' => $area_programa[array_rand($area_programa)]['codare'],
            'data_horario' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '+2 years'),
            'sala' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'orientador' => $orientador,
        ];
    }
}