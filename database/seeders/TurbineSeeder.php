<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TurbineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Create randon registers to farm table
        \App\Models\Turbine::factory()->count(3)->create();
    }
}
