<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agendamento;
use Faker\Generator as Faker;

$factory->define(Agendamento::class, function (Faker $faker) {
    $sexo = Agendamento::sexoOptions(); 
    $regimento = Agendamento::regimentoOptions(); 
    $nivel = Agendamento::nivelOptions(); 
    $area_programa = Agendamento::programaOptions();
    $sala = Agendamento::salaOptions();
    return [
        'codpes' => $faker->unique()->posgraduacao(),
        'regimento' => $regimento[array_rand($regimento)],
        'orientador_votante' => 'Não',
        'sexo' => $sexo[array_rand($sexo)],
        'nivel' => $nivel[array_rand($nivel)],
        'titulo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'area_programa' => $area_programa[array_rand($area_programa)],
        'data_horario' => $faker->dateTime,
        'sala' => $sala[array_rand($sala)],
        'orientador' => $faker->docente(), 
    ];
});
