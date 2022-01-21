<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // naming convention
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get()

        ]);
    }

    public function show(Post $post)
    {
// defaulted to find by the key, in this case, would be ID
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
