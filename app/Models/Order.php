<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'merchant_id',
        'product_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'platform',
        'quantity',
        'total_amount',
        'payment_proof',
        'status',
    ];

    /**
     * Relasi ke pengguna yang membuat pesanan (pembeli).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke merchant (penjual) yang produknya dipesan.
     */
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    /**
     * Relasi ke produk yang dipesan.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
