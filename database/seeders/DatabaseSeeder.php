<?php

namespace Database\Seeders;

use App\Models\disciplina;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            // userSeeder::class,
            // disciplinaSeeder::class,
            // turmaSeeder::class
            // professor_disciplinaSeeder::class,
            // materiaSeeder::class
            material_aulasSeeder::class
        ]);
    }
}
