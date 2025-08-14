<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('merchants.dashboard.index'); // Pastikan view ini ada di resources/views/merchants/dashboard/index.blade.php
    }
}
