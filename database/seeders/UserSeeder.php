<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // Role admin
        ]);
        
        User::create([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user', // Role user
        ]);
        
    }
}
