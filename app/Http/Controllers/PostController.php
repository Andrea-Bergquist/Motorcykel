<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
      
        return view('welcome', compact('posts'));
    }
}
