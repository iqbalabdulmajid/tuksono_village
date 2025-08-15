<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua kategori untuk ditampilkan sebagai tombol filter
        $categories = Category::orderBy('name')->get();

        // Mulai query builder untuk produk
        $query = Product::query();

        // Terapkan filter jika ada parameter 'category' di URL
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Ambil produk dengan pagination
        $products = $query->latest()->paginate(9);

        // Pastikan pagination tetap membawa parameter filter
        $products->appends($request->query());

        return view('users.product.index', compact('products', 'categories'));
    }

    public function show(Product $product)
{
    // Memuat relasi owner dan merchant sekaligus untuk menghindari N+1 problem
    $product->load('owner.merchant', 'categories');
    // dd($product->owner->merchant);
    // Ambil produk serupa dari merchant yang sama
    $similarProducts = collect();
    if ($product->owner->merchant) {
        $similarProducts = Product::where('id', '!=', $product->id)
            ->where('id', $product->owner->merchant->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }

    return view('users.product.show', compact('product', 'similarProducts'));
}
}
