<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- 1. TAMBAHKAN IMPORT INI

// =====================================================================
// == User Routes (Akses umum)                                      ==
// =====================================================================
Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\User\AboutController::class, 'index'])->name('about');
Route::get('/product', [App\Http\Controllers\User\ProductController::class, 'index'])->name('product');
Route::get('/blog', [App\Http\Controllers\User\BlogController::class, 'index'])->name('blog');
Route::get('/blog/show', [App\Http\Controllers\User\BlogController::class, 'show'])->name('blog.show');
// Route::get('/product/show', [App\Http\Controllers\User\ProductController::class, 'show'])->name('product.show');
Route::get('/contact', [App\Http\Controllers\User\ContactController::class, 'index'])->name('contact');
Route::controller(App\Http\Controllers\User\ProductController::class)->prefix('product')->name('product.')->group(function () {
    Route::get('/{product}', 'show')->name('show');
});
// =====================================================================
// == Admin Routes (Hanya bisa diakses oleh role 'admin')           ==
// =====================================================================
Auth::routes();
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // URL: /admin/dashboard, Name: admin.dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', App\Http\Controllers\Admin\ProductController::class);
    // Tambahkan route admin lainnya di sini, contoh:
    // Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
    // Route::get('/settings', [Admin\SettingsController::class, 'index'])->name('settings');
});


// =====================================================================
// == Pemilik Usaha Routes (Hanya bisa diakses oleh 'pemilik_usaha') ==
// =====================================================================

// Grup route untuk Merchant (Pemilik Usaha)
Route::middleware(['auth', 'role:pemilik_usaha'])->prefix('merchant')->name('merchant.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Merchant\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Merchant\ProductController::class);

    // Tambahkan route merchant lainnya di sini
});


