<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Simpatisan>
 */
class SimpatisanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->numerify('##############'),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'sex' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'regency_id' => $this->faker->randomElement(range(1, 4)),
            'district_id' => $this->faker->randomElement(range(1, 10)),
            'subdistrict_id' => $this->faker->randomElement(range(1, 10)),
            'ktp' => $this->faker->creditCardNumber(),
            'user_id' => $this->faker->randomElement(range(1, 3))
        ];
    }
}
