<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Merchant; // Menggunakan model Merchant yang baru
use App\Models\User; // Masih diperlukan untuk filter user di index
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Eager load relationships untuk efisiensi
        $query = Product::with(['merchant', 'owner', 'categories']);

        // Filter Pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan Merchant (sekarang menggunakan merchant_id)
        if ($request->filled('merchant_id')) {
            $query->where('merchant_id', $request->merchant_id);
        }

        // Filter berdasarkan Kategori
        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        // Logika Pengurutan
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $sortableColumns = ['name', 'price', 'created_at'];
        if (in_array($sortBy, $sortableColumns)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            $query->latest();
        }

        // Logika Pagination
        $perPage = $request->input('per_page', 10);
        $products = $query->paginate($perPage)->appends($request->query());

        // Ambil data untuk dropdown filter
        $merchants = Merchant::orderBy('nama_toko')->get();
        $categories = Category::orderBy('name')->get();

        return view('admins.products.index', compact('products', 'merchants', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $merchants = Merchant::orderBy('nama_toko')->get();
        $categories = Category::all();
        return view('admins.products.create', compact('merchants', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'link_shopee' => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_fb_marketplace' => 'nullable|url',
            'link_tanihub' => 'nullable|url',
            'merchant_id' => 'required|exists:merchants,id', // Validasi merchant_id
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Temukan user_id dari merchant_id yang dipilih
        $merchant = Merchant::findOrFail($request->merchant_id);

        $product = Product::create([
            'user_id' => $merchant->user_id, // Simpan user_id dari merchant
            'merchant_id' => $request->merchant_id, // Simpan merchant_id
            'name' => $request->name,
            'description' => $request->description,
            'price' => str_replace('.', '', $request->price),
            'image' => $imagePath,
            'link_shopee' => $request->link_shopee,
            'link_tokopedia' => $request->link_tokopedia,
            'link_fb_marketplace' => $request->link_fb_marketplace,
            'link_tanihub' => $request->link_tanihub,
        ]);

        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $merchants = Merchant::orderBy('nama_toko')->get();
        $categories = Category::all();
        $product->load('categories');
        return view('admins.products.edit', compact('product', 'merchants', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'link_shopee' => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_fb_marketplace' => 'nullable|url',
            'link_tanihub' => 'nullable|url',
            'merchant_id' => 'required|exists:merchants,id', // Validasi merchant_id
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Temukan user_id dari merchant_id yang dipilih
        $merchant = Merchant::findOrFail($request->merchant_id);

        $product->update([
            'user_id' => $merchant->user_id, // Perbarui user_id
            'merchant_id' => $request->merchant_id, // Perbarui merchant_id
            'name' => $request->name,
            'description' => $request->description,
            'price' => str_replace('.', '', $request->price),
            'image' => $imagePath,
            'link_shopee' => $request->link_shopee,
            'link_tokopedia' => $request->link_tokopedia,
            'link_fb_marketplace' => $request->link_fb_marketplace,
            'link_tanihub' => $request->link_tanihub,
        ]);

        $product->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show(Product $product)
    {
        return view('admins.products.show', compact('product'));
    }
}
