<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subdistrict::truncate();

        $csvFile = fopen(base_path("public/seeders/subdistricts.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Subdistrict::create([
                    "id" => $data['0'],
                    "name" => $data['1'],
                    "district_id" => $data['2']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
