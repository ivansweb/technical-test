<?php

namespace Database\Factories;

use App\Models\Farm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TurbineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $farmIds = Farm::pluck('id')->toArray();

        return [
            'uuid' => $this->faker->uuid(),
            'farm_id' => $this->faker->randomElement($farmIds),
            'serial_number' => $this->faker->numberBetween(1, 99999),
            'model' => $this->faker->randomElement(['GE 1.5sle', 'GE 2.0sle', 'GE 2.5sle']),
            'manufacturer' => $this->faker->randomElement(['GE', 'Vestas', 'Siemens']),
            'installation_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
