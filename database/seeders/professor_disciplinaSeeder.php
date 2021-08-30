<?php

namespace Database\Seeders;

use App\Models\professor_disciplina;
use Illuminate\Database\Seeder;

class professor_disciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        professor_disciplina::factory()->count(15)->create();
    }
}
