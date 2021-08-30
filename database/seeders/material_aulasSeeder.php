<?php

namespace Database\Seeders;

use App\Models\material_aulas;
use Illuminate\Database\Seeder;

class material_aulasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        material_aulas::factory()->count(15)->create();
    }
}
