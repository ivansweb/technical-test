<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Grade::updateOrCreate([
            'name' => 'Perfect',
            'value' => '1',
        ]);

        Grade::updateOrCreate([
            'name' => 'Very Good',
            'value' => '2',
        ]);


        Grade::updateOrCreate([
            'name' => 'Good',
            'value' => '3',
        ]);

        Grade::updateOrCreate([
            'name' => 'Regular',
            'value' => '4',
        ]);

        Grade::updateOrCreate([
            'name' => 'Missing/Broken',
            'value' => '5',
        ]);
    }
}
