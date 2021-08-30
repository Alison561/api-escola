<?php

namespace Database\Factories;

use App\Models\disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

class disciplinaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = disciplina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->text(50),
            'img' => 'disciplinas/9Pjlngx1aOMu8VQJ0dWFTkWwQIXHtGeRrlt2TcJ6.jpg',
        ];
    }
}
