<?php

namespace Database\Seeders;

use App\Models\Simpatisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimpatisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Simpatisan::factory()->count(2000)->create();
    }
}
