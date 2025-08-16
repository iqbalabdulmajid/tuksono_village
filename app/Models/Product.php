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
        'merchant_id', // Tambahkan merchant_id untuk relasi dengan Merchant
        'name',
        'description',
        'price',
        'image',
        'link_shopee',
        'link_tokopedia',
        'link_fb_marketplace',
        'link_tanihub',
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

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
