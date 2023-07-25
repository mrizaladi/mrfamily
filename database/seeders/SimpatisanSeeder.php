<?php

namespace Database\Seeders;

use App\Models\Simpatisan;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class SimpatisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Simpatisan::factory()->count(5000)->create();

        $data = [];
        for ($i=0; $i < 500000; $i++) { 
            $data[] = [
                'updated_at' => now(),
                'created_at' => now(),
                'nik' => fake()->nik(),
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'sex' => fake()->randomElement(['Laki-Laki', 'Perempuan']),
                'regency_id' => fake()->randomElement(range(1, 4)),
                'district_id' => fake()->randomElement(range(1, 10)),
                'subdistrict_id' => fake()->randomElement(range(1, 10)),
                'ktp' => fake()->creditCardNumber(),
                'user_id' => fake()->randomElement(range(1, 3))
            ];
        }

        foreach(array_chunk($data, 1000) as $chunk){
            Simpatisan::insert($chunk);
        }
    }
}
