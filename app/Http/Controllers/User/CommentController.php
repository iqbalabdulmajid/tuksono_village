<?php
// 4. Buat controller baru: app/Http/Controllers/User/CommentController.php
// Jalankan: php artisan make:controller User/CommentController

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment_body' => 'required|string|max:2000',
        ]);

        Auth::user()->comments()->create([
            'post_id' => $request->post_id,
            'body' => $request->comment_body,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
