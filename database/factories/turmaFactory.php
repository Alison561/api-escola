<?php

namespace Database\Factories;

use App\Models\turma;
use Illuminate\Database\Eloquent\Factories\Factory;

class turmaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = turma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->text(20),
        ];
    }
}
