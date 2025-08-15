<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Merchant;


class MerchantController extends Controller
{
    public function showAllProducts($slug)
    {
        $merchant = Merchant::where('slug', $slug)->firstOrFail();
        $products = $merchant->products; // Asumsi model Merchant punya relasi `hasMany` ke Product

        return view('users.merchant.products', compact('merchant', 'products'));
    }
}
