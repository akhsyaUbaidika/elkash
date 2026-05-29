<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@elkash.local',
            ],
            [
                'name' => 'Super Admin',
                'password' => 'password123',
                'phone' => '08123456789',
                'is_active' => true,
            ]
        );

        $user->assignRole('Super Admin');
    }
}