<?php

namespace Database\Seeders;

use App\Models\turma;
use Illuminate\Database\Seeder;

class turmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        turma::factory()->count(10)->create();
    }
}
