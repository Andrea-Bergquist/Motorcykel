<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Post;

class AdminController extends Controller
{

     public function index()
    {
        $posts = Post::latest()->paginate(5);
        
        return view('admin.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validera inkommande data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Skapa posten i databasen
        Post::create($validated);

        // Skicka tillbaka användaren med ett framgångsmeddelande
        return redirect()->route('posts.index')
            ->with('success', 'Inlägget har skapats!');
    }

    public function show(Post $post)
    {
        // $post är tack vare Route Model Binding redan hämtad från databasen
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validera data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Uppdatera posten
        $post->update($validated);

        return redirect()->route('admin.index')
            ->with('success', 'Inlägget har uppdaterats!');
    }

    public function destroy(Post $post)
    {
        // Radera posten
        $post->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Inlägget har raderats!');
    }
}
