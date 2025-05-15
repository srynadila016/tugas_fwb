<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('custom_user')->insert([
            [
                'name' => 'Owner User',
                'email' => 'owner@example.com',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembeli User',
                'email' => 'pembeli@example.com',
                'password' => Hash::make('password123'),
                'role' => 'pembeli',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
