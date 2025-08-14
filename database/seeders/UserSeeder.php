<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // passwordnya: "password"
        ]);

        // Membuat akun User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => Hash::make('password'), // passwordnya: "password"
        ]);

        // (Opsional) Membuat 10 user biasa lainnya menggunakan factory
        // User::factory()->count(10)->create();
    }
}
