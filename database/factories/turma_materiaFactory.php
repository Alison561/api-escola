<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\turma_materia;
use Illuminate\Database\Eloquent\Factories\Factory;

class turma_materiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = turma_materia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'turma_id' => $this->faker->numberBetween(1, 12),
            'materia_id' => $this->faker->unique()->numberBetween(1, 20),
        ];
    }
}
