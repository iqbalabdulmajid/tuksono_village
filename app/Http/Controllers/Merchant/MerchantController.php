<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Product;

class MerchantController extends Controller
{
    public function showAllProducts($slug)
    {
        // Ambil merchant
        $merchant = Merchant::where('slug', $slug)->firstOrFail();

        // Pastikan ambil dari query builder, bukan Collection
        $products = Product::where('merchant_id', $merchant->id)->paginate(12);


        return view('users.merchant.products', compact('merchant', 'products'));
    }
}
