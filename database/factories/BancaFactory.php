<?php

namespace Database\Factories;

use App\Models\Banca;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Docente;

class BancaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banca::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipo = Banca::tipoOptions();
        $docente = Docente::factory()->create()->n_usp;
        return [
            'codpes' => $docente,
            'presidente' => 'Não',
            'tipo' => $tipo[array_rand($tipo)],
        ];
    }
}
