<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- 1. TAMBAHKAN IMPORT INI

// =====================================================================
// == User Routes (Akses umum)                                      ==
// =====================================================================
Route::get('/', [App\Http\Controllers\User\Dashboard::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\User\About::class, 'index'])->name('about');
Route::get('/product', [App\Http\Controllers\User\Product::class, 'index'])->name('product');
Route::get('/blog', [App\Http\Controllers\User\Blog::class, 'index'])->name('blog');
Route::get('/blog/show', [App\Http\Controllers\User\Blog::class, 'show'])->name('blog.show');
Route::get('/product/show', [App\Http\Controllers\User\Product::class, 'show'])->name('product.show');
Route::get('/contact', [App\Http\Controllers\User\Contact::class, 'index'])->name('contact');
// =====================================================================
// == Admin Routes (Hanya bisa diakses oleh role 'admin')           ==
// =====================================================================
Auth::routes();
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // URL: /admin/dashboard, Name: admin.dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard::class, 'index'])->name('dashboard');

    // Tambahkan route admin lainnya di sini, contoh:
    // Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    // Route::get('/settings', [Admin\SettingsController::class, 'index'])->name('settings');
});


// =====================================================================
// == Pemilik Usaha Routes (Hanya bisa diakses oleh 'pemilik_usaha') ==
// =====================================================================
/*
// Uncomment (aktifkan) blok ini jika Anda sudah siap menggunakannya.
Route::middleware(['auth', 'role:pemilik_usaha'])->prefix('owner')->name('owner.')->group(function () {

    // Contoh route untuk pemilik usaha:
    // URL: /owner/dashboard, Name: owner.dashboard
    // Route::get('/dashboard', [Owner\DashboardController::class, 'index'])->name('dashboard');

    // URL: /owner/reports, Name: owner.reports.index
    // Route::get('/reports', [Owner\ReportController::class, 'index'])->name('reports.index');

});
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
