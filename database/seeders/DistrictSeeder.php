<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        District::truncate();

        $csvFile = fopen(base_path("public/seeders/districts.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                District::create([
                    "id" => $data['0'],
                    "name" => $data['1'],
                    "regency_id" => $data['2']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
