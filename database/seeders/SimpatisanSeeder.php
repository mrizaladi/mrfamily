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
        Simpatisan::truncate();

        $csvFile = fopen(base_path("public/seeders/kendal.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Simpatisan::create([
                    "id" => $data['0'],
                    "name" => $data['1'],
                    "sex" => $data['2'],
                    "age" => $data['3'],
                    "regency_id" => $data['4'],
                    "district_id" => $data['5'],
                    "subdistrict_id" => $data['6'],
                    "rt" => $data['7'],
                    "rw" => $data['8'],
                    "tps" => $data['9']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
