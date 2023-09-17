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
        $userRole = Role::create(['name' => 'user']);

        $superadmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@mr-family.com',
            'password' => Hash::make('superadmin'),
            'regency_id' => '1',
            'district_id' => '1',
            'subdistrict_id' => '1',
            'admin' => 1,
            'approved_at' => now()
        ]);

        $adminUsers = [
            [
                'name' => 'Martin',
                'email' => 'martin@mr-family.com',
                'password' => Hash::make('admin123'),
                'regency_id' => '1',
                'district_id' => '1',
                'subdistrict_id' => '1',
                'admin' => 1,
                'approved_at' => now()
            ],
            [
                'name' => 'Sub Admin Kendal',
                'email' => 'subadmin_kendal@mr-family.com',
                'password' => Hash::make('admin123'),
                'regency_id' => '1',
                'district_id' => '1',
                'subdistrict_id' => '1',
                'admin' => 1,
                'approved_at' => now()
            ],
            [
                'name' => 'Din',
                'email' => 'udcok@mr-family.com',
                'password' => Hash::make('admin123'),
                'regency_id' => '2',
                'district_id' => '1',
                'subdistrict_id' => '1',
                'admin' => 1,
                'approved_at' => now()
            ],
            [
                'name' => 'Adidas',
                'email' => 'adidas@mr-family.com',
                'password' => Hash::make('admin123'),
                'regency_id' => '4',
                'district_id' => '1',
                'subdistrict_id' => '1',
                'admin' => 1,
                'approved_at' => now()
            ],
            [
                'name' => 'Jun',
                'email' => 'junaedi@mr-family.com',
                'password' => Hash::make('admin123'),
                'regency_id' => '3',
                'district_id' => '1',
                'subdistrict_id' => '1',
                'admin' => 1,
                'approved_at' => now()
            ]
        ];

        foreach ($adminUsers as $userData) {
            $adminUser = User::create($userData);
            $adminUser->assignRole('admin');
        }

        $superadmin->assignRole('superadmin');

        // Create permissions
        Permission::create(['name' => 'access all pages']);
        Permission::create(['name' => 'access tps page']);
        Permission::create(['name' => 'access simpatisan page']);

        // Assign permissions to roles
        $superadminRole->givePermissionTo('access all pages');
        $adminRole->givePermissionTo('access all pages');
        $userRole->givePermissionTo('access tps page', 'access simpatisan page');

        $this->call([
            RegencySeeder::class,
            DistrictSeeder::class,
            SubdistrictSeeder::class,
            SimpatisanSeeder::class,
            TpsSeeder::class,
        ]);
    }
}
