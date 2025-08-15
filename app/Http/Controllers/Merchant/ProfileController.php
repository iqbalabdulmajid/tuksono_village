<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'whatsapp_number' => 'nullable|string|max:20|regex:/^62\d+$/',
        ], [
            'whatsapp_number.regex' => 'Format nomor WhatsApp salah. Awali dengan 62 dan hanya berisi angka.'
        ]);

        $user->update([
            'name' => $request->name,
            'whatsapp_number' => $request->whatsapp_number,
        ]);

        return redirect()->route('merchant.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
