<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $perangkatDesa = PerangkatDesa::all();

        return view('users.about.index', compact('perangkatDesa'));
    }
}
