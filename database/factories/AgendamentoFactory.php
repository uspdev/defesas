<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agendamento;
use Faker\Generator as Faker;
use Uspdev\Replicado\Pessoa;

$factory->define(Agendamento::class, function (Faker $faker) {
    $sexo = Agendamento::sexoOptions(); 
    $regimento = Agendamento::regimentoOptions(); 
    $nivel = Agendamento::nivelOptions(); 
    $area_programa = Agendamento::programaOptions();
    $sala = Agendamento::salaOptions();
    $aluno = $faker->unique()->posgraduacao();
    $orientador = $faker->docente();
    return [
        'codpes' => $aluno,
        'nome' => Pessoa::dump($aluno)['nompes'],
        'regimento' => $regimento[array_rand($regimento)],
        'orientador_votante' => 'Não',
        'sexo' => $sexo[array_rand($sexo)],
        'nivel' => $nivel[array_rand($nivel)],
        'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'area_programa' => $area_programa[array_rand($area_programa)],
        'data_horario' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 years'),
        'sala' => $sala[array_rand($sala)],
        'orientador' => $orientador,
        'nome_orientador' => Pessoa::dump($orientador)['nompes'], 
    ];
});
