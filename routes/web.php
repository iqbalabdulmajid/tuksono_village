<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- 1. TAMBAHKAN IMPORT INI

// =====================================================================
// == User Routes (Akses umum)                                      ==
// =====================================================================
Route::get('/', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\User\AboutController::class, 'index'])->name('about');
Route::get('/product', [App\Http\Controllers\User\ProductController::class, 'index'])->name('product');
Route::controller(App\Http\Controllers\User\BlogController::class)->prefix('blog')->name('blog.')->group(function () {
    // URL: /blog
    // Nama: blog.index
    Route::get('/', 'index')->name('index');

    // URL: /blog/{slug-artikel}
    // Nama: blog.show
    Route::get('/{post:slug}', 'show')->name('show');
});// Route::get('/product/show', [App\Http\Controllers\User\ProductController::class, 'show'])->name('product.show');
Route::get('/contact', [App\Http\Controllers\User\ContactController::class, 'index'])->name('contact');
Route::controller(App\Http\Controllers\User\ProductController::class)->prefix('product')->name('product.')->group(function () {
    Route::get('/{product}', 'show')->name('show');
});
Route::post('/register/merchant', [App\Http\Controllers\Auth\RegisterController::class, 'createMerchant'])->name('register.merchant');
Route::get('/store/{slug}', [App\Http\Controllers\User\MerchantController::class, 'showAllProducts'])->name('merchant.show');
Route::post('/comments', [App\Http\Controllers\User\CommentController::class, 'store'])->name('comments.store')->middleware('auth');


// =====================================================================
// == Admin Routes (Hanya bisa diakses oleh role 'admin')           ==
// =====================================================================
Auth::routes();
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // URL: /admin/dashboard, Name: admin.dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'show']);
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class); // <-- TAMBAHKAN INI
    // Route::get('/settings', [Admin\SettingsController::class, 'index'])->name('settings');
});


// =====================================================================
// == Pemilik Usaha Routes (Hanya bisa diakses oleh 'pemilik_usaha') ==
// =====================================================================

// Grup route untuk Merchant (Pemilik Usaha)
Route::middleware(['auth', 'role:pemilik_usaha'])->prefix('merchant')->name('merchant.')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Merchant\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Merchant\ProductController::class);
    Route::get('/profile', [App\Http\Controllers\Merchant\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Merchant\ProfileController::class, 'update'])->name('profile.update');

    // Tambahkan route merchant lainnya di sini
});


