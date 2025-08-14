<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun untuk Pemilik Usaha (Merchant)
        User::create([
            'name' => 'Pemilik Usaha Satu',
            'email' => 'merchant@gmail.com',
            'role' => 'pemilik_usaha', // Pastikan role sesuai dengan yang kita sepakati
            'password' => Hash::make('password'), // passwordnya adalah "password"
        ]);
    }
}
