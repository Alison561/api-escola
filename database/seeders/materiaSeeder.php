<?php

namespace Database\Seeders;

use App\Models\turma_materia;
use Illuminate\Database\Seeder;

class materiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        turma_materia::factory()->count(15)->create();
    }
}
