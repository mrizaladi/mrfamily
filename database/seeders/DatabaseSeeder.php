<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superadminRole = Role::create(['name' => 'superadmin']);
        $adminRole = Role::create(['name' => 'admin']);


        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mrfamily.com',
            'password' => Hash::make('admin'),
            'regency_id' => '1',
            'district_id' => '1',
            'subdistrict_id' => '1',
            'admin' => 1,
            'approved_at' => now()
        ]);

        $superadmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@mrfamily.com',
            'password' => Hash::make('superadmin'),
            'regency_id' => '1',
            'district_id' => '1',
            'subdistrict_id' => '1',
            'admin' => 1,
            'approved_at' => now()
        ]);

        $admin->assignRole('admin');
        $superadmin->assignRole('superadmin');

        // Create permissions
        Permission::create(['name' => 'access all pages']);
        Permission::create(['name' => 'access tps page']);
        Permission::create(['name' => 'access simpatisan page']);

        // Assign permissions to roles
        $superadminRole->givePermissionTo('access all pages');
        $adminRole->givePermissionTo('access tps page', 'access simpatisan page');

        $this->call([
            RegencySeeder::class,
            DistrictSeeder::class,
            SubdistrictSeeder::class,
            SimpatisanSeeder::class,
            TpsSeeder::class,
        ]);
    }
}
