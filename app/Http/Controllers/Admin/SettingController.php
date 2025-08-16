<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Menampilkan halaman form pengaturan
    public function index()
    {
        // Ambil semua setting, ubah menjadi array asosiatif [key => value]
        $settings = Setting::pluck('value', 'key')->all();
        return view('admins.settings.index', compact('settings'));
    }

    // Menyimpan atau memperbarui pengaturan
    public function update(Request $request)
    {
        // Loop melalui semua data yang dikirim dari form
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
