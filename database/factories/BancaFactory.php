<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Banca;
use Faker\Generator as Faker;

$factory->define(Banca::class, function (Faker $faker) {
    return [
        'codpes' => $faker->docente(),
        'presidente' => 'Não',
    ];
});
