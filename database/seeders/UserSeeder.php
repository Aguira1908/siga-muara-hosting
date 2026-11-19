<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Operator Kecamatan',
            'email' => 'operator@sigapmuara.test',
            'password' => Hash::make('password123'),
            'role' => 'operator',
        ]);

        User::create([
            'name' => 'Camat Muara',
            'email' => 'camat@sigapmuara.test',
            'password' => Hash::make('password123'),
            'role' => 'camat',
        ]);
    }
}