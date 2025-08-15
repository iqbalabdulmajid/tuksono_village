<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6); // Membuat judul dengan 6 kata

        return [
            // Mengambil ID user admin secara acak sebagai penulis
            'user_id' => User::where('role', 'admin')->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(10, true), // Membuat 10 paragraf konten
            'image' => 'posts/default.jpg', // Gunakan gambar default, pastikan file ini ada
            'published_at' => now()->subDays(rand(1, 30)), // Publikasi dalam 30 hari terakhir
        ];
    }
}
