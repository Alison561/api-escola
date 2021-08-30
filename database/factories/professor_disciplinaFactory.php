<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\professor_disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

class professor_disciplinaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = professor_disciplina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'disciplina_id' => $this->faker->numberBetween(2, 16),
        ];
    }
}
