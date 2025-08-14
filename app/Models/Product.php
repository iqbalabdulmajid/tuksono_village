<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Pastikan user_id sudah ada di sini
        'name',
        'description',
        'price',
        'image',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi baru ke Category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
