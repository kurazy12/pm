<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create staff users (one for each province)
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Staff User ' . $i,
                'email' => 'staff' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'province_id' => $i,
            ]);
        }

        // Create regular users
        User::factory(20)->create();

        // Create users with specific provinces
        User::factory(15)->create([
            'province_id' => function() {
                return rand(1, 10); // Assume we have 10 provinces
            }
        ]);
    }
}
