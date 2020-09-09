<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Banca;
use App\Docente;
use Faker\Generator as Faker;

$factory->define(Banca::class, function (Faker $faker) {
    $tipo = Banca::tipoOptions();
    $docente = factory(Docente::class, 1)->create();
    return [
        'codpes' => $docente[0]['n_usp'],
        'presidente' => 'Não',
        'tipo' => $tipo[array_rand($tipo)],
    ];
});
