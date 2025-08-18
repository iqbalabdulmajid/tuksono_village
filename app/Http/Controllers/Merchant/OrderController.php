<?php
// 1. Buat Controller baru: app/Http/Controllers/Merchant/OrderController.php
// Jalankan: php artisan make:controller Merchant/OrderController

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan yang masuk untuk merchant.
     */
    public function index(Request $request)
    {
        // Memulai query untuk mengambil pesanan HANYA milik merchant yang login
        $query = Order::where('merchant_id', Auth::id())->with(['user', 'product']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->appends($request->query());

        return view('merchants.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Pastikan merchant hanya bisa melihat pesanan miliknya
        if ($order->merchant_id !== Auth::id()) {
            abort(403);
        }

        return view('merchants.orders.show', compact('order'));
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        if ($order->merchant_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Baru,Diproses,Selesai,Dibatalkan',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('merchant.orders.show', $order->id)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
