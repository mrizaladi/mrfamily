<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mrfamily.com',
            'password' => Hash::make('admin'),
            'regency_id' => '1',
            'district_id' => '1',
            'subdistrict_id' => '1',
        ]);

        $this->call([
            RegencySeeder::class,
            DistrictSeeder::class,
            SubdistrictSeeder::class,
        ]);
    }
}
