<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Hapus properti statis ini karena kita akan menggunakan method dinamis.
     * protected $redirectTo = '/home';
     */

    /**
     * Menentukan ke mana pengguna akan diarahkan setelah login berhasil.
     * Method ini akan secara otomatis memeriksa peran pengguna.
     *
     * @return string
     */
    protected function redirectTo()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return route('admin.dashboard'); // Arahkan ke dashboard admin
            case 'pemilik_usaha':
                return '/owner/dashboard'; // Arahkan ke dashboard pemilik usaha
            default:
                return '/'; // Arahkan pengguna biasa ke halaman utama
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
