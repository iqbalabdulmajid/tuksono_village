<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil user (merchant) yang sedang login
        $merchant = Auth::user();

        // Menghitung total produk HANYA milik merchant ini
        $totalProducts = $merchant->products()->count();

        // Mengambil 5 produk terbaru HANYA milik merchant ini
        $recentProducts = $merchant->products()->latest()->take(5)->get();

        // Data placeholder untuk fitur mendatang
        $totalOrders = 0; // Ganti dengan logika pesanan nanti
        $totalSales = 0; // Ganti dengan logika penjualan nanti

        return view('merchants.dashboard.index', compact(
            'totalProducts',
            'totalOrders',
            'totalSales',
            'recentProducts'
        ));
    }
}
