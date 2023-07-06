<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tps>
 */
class TpsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'regency_id' => $this->faker->randomElement(range(1,4)),
            'district_id' => $this->faker->randomElement(range(1,10)),
            'subdistrict_id' => $this->faker->randomElement(range(1,10)),
            'village' => $this->faker->streetName(),
            'tps' => $this->faker->randomElement(range(1,100)),
            'officer' => $this->faker->name(),
            'total_voters' => $this->faker->numberBetween(1000000,2000000),
        ];
    }
}
