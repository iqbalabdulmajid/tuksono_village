<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'platform' => 'required|string',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($request->product_id);
        $paymentProofPath = null;

        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('proofs', 'public');
        }

        Order::create([
            'user_id' => Auth::id(), // Akan null jika user tidak login
            'merchant_id' => $product->user_id,
            'product_id' => $product->id,
            'platform' => $request->platform,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'quantity' => $request->quantity,
            'total_amount' => $product->price * $request->quantity,
            'payment_proof' => $paymentProofPath,
            'status' => 'Baru',
        ]);

        return back()->with('success', 'Pesanan Anda telah dicatat. Merchant akan segera menghubungi Anda.');
    }
}
