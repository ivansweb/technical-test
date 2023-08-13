<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Component::updateOrCreate([
            'name' => 'Tower',
        ]);

        Component::updateOrCreate([
            'name' => 'Rotor',
        ]);

        Component::updateOrCreate([
            'name' => 'Blades',
        ]);

        Component::updateOrCreate([
            'name' => 'Hub',
        ]);

        Component::updateOrCreate([
            'name' => 'Controller',
        ]);

    }
}
