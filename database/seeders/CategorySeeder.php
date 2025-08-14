<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Import model Category
use Illuminate\Support\Str; // Import Str untuk membuat slug

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar kategori yang akan dibuat
        $categories = [
            'Pupuk Organik',
            'Pupuk Anorganik',
            'Pestisida Nabati',
            'Herbisida',
            'Benih Sayuran',
            'Peralatan Pertanian',
            'Media Tanam',
        ];

        // Looping untuk setiap kategori dan menyimpannya ke database
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), // Membuat slug otomatis, misal: "pupuk-organik"
            ]);
        }
    }
}
