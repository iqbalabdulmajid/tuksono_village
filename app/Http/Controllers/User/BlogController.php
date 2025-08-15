<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a list of all blog posts.
     */
    public function index()
    {
        $posts = Post::with('author')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(6); // Show 6 posts per page

        $recentPosts = Post::whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('users.blog.index', compact('posts', 'recentPosts'));
    }

    /**
     * Display a single blog post.
     */
    public function show(Post $post)
    {
        // Ensure only published posts can be viewed
        if (!$post->published_at) {
            abort(404);
        }
        $post->load(['comments.user']);


        $recentPosts = Post::where('id', '!=', $post->id)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('users.blog.show', compact('post', 'recentPosts'));
    }
}
