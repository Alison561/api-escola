<?php

namespace Database\Seeders;

use App\Models\disciplina;
use Illuminate\Database\Seeder;

class disciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        disciplina::factory()->count(15)->create();
    }
}
