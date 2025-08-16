<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('merchants.profile.edit', compact('user'));
    }

    /**
     * Memproses update data profil.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nama_toko' => 'required|string|max:255',
            'alamat_toko' => 'required|string|max:255',
            'deskripsi_toko' => 'nullable|string|max:1000',
            'whatsapp_number' => 'nullable|string|max:20|regex:/^62\d+$/',
        ], [
            'whatsapp_number.regex' => 'Format nomor WhatsApp salah. Awali dengan 62 dan hanya berisi angka.'
        ]);

        // Perbarui data di tabel users
        $user->update([
            'name' => $request->name,
            'whatsapp_number' => $request->whatsapp_number,
            'alamat_toko' => $request->alamat_toko,
            'deskripsi_toko' => $request->deskripsi_toko,
        ]);

        // Perbarui data di tabel merchants melalui relasi
        if ($user->merchant) {
            $user->merchant->update([
                'nama_toko' => $request->nama_toko,
                'slug' => Str::slug($request->nama_toko),
                'alamat_toko' => $request->alamat_toko,
                'deskripsi_toko' => $request->deskripsi_toko,
            ]);
        }

        return redirect()->route('merchant.profile.edit')->with('success', 'Profil dan informasi toko berhasil diperbarui.');
    }
}
