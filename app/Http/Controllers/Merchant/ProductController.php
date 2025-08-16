<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk HANYA milik merchant yang sedang login.
     */
    public function index(Request $request)
    {
        // Mengambil merchant_id dari user yang sedang login
        $merchantId = Auth::user()->merchant->id;

        // Memulai query dari produk milik merchant yang sedang login
        $query = Product::where('merchant_id', $merchantId)->with('categories');

        // Fungsionalitas Pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10)->appends($request->query());

        return view('merchants.products.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('merchants.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'link_shopee' => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_fb_marketplace' => 'nullable|url',
            'link_tanihub' => 'nullable|url',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Ambil ID dari merchant yang sedang login
        $merchant = Auth::user()->merchant;

        $product = Product::create([
            'user_id' => Auth::id(), // Simpan user_id
            'merchant_id' => $merchant->id, // Simpan merchant_id
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

        return redirect()->route('merchant.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu produk.
     */
    public function show(Product $product)
    {
        if ($product->merchant_id !== Auth::user()->merchant->id) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }
        $product->load(['categories', 'reviews.user']);


        return view('merchants.products.show', compact('product'));
    }

    /**
     * Menampilkan form untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        if ($product->merchant_id !== Auth::user()->merchant->id) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }

        $categories = Category::all();
        $product->load('categories');
        return view('merchants.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk di database.
     */
    public function update(Request $request, Product $product)
    {
        if ($product->merchant_id !== Auth::user()->merchant->id) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'link_shopee' => 'nullable|url',
            'link_tokopedia' => 'nullable|url',
            'link_fb_marketplace' => 'nullable|url',
            'link_tanihub' => 'nullable|url',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
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

        return redirect()->route('merchant.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(Product $product)
    {
        if ($product->merchant_id !== Auth::user()->merchant->id) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('merchant.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
