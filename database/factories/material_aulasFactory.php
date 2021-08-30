<?php

namespace Database\Factories;

use App\Models\material_aulas;
use Illuminate\Database\Eloquent\Factories\Factory;

class material_aulasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = material_aulas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'materia_id' => $this->faker->numberBetween(1, 12),
            'nome' => $this->faker->text(20),
            'arquivo' => 'material_aulas/PuRwa859G04V1S2wES3IApT3ph1NZeBjk85EmApX.pdf',
        ];
    }
}
