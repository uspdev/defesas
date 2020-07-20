<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Banca;
use Faker\Generator as Faker;

$factory->define(Banca::class, function (Faker $faker) {
    $tipo = Banca::tipoOptions();
    return [
        'codpes' => $faker->docente(),
        'presidente' => 'Não',
        'tipo' => $tipo[array_rand($tipo)],
    ];
});
