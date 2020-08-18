<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Banca;
use Faker\Generator as Faker;
use Uspdev\Replicado\Pessoa;

$factory->define(Banca::class, function (Faker $faker) {
    $tipo = Banca::tipoOptions();
    $docente = $faker->docente();
    return [
        'codpes' => $docente,
        'nome' => Pessoa::dump($docente)['nompes'],
        'presidente' => 'Não',
        'tipo' => $tipo[array_rand($tipo)],
    ];
});
