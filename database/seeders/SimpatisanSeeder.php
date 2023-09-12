<?php

namespace Database\Seeders;

use App\Models\Simpatisan;
use Illuminate\Database\Seeder;


class SimpatisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $totalRecords = 1000;
        $batchSize = 80;

        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            $dummyData = $this->generateDummyData(min($batchSize, $totalRecords - $i));
            Simpatisan::insert($dummyData);
        }
    }

    private function generateDummyData($count): array
    {
        $dummyData = [];
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < $count; $i++) {
            $dummyData[] = [
                'created_at' => now(),
                'updated_at' => now(),
                'name' => $faker->name(),
                'sex' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
                'regency_id' => $faker->randomElement(range(1, 1)),
                'district_id' => $faker->randomElement(range(1, 1)),
                'subdistrict_id' => $faker->randomElement(range(1, 1)),
                'user_id' => $faker->randomElement(range(1, 3)),
                'usia' => $faker->randomElement(range(1, 3)),
                'rt' => $faker->randomElement(range(1, 3)),
                'rw' => $faker->randomElement(range(1, 3)),
                'tps' => $faker->randomElement(range(1, 3)),

            ];
        }

        return $dummyData;
    }
}
