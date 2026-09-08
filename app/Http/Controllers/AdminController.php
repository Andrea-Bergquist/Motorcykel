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
        // 1. Validera data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg', // Ändrat till nullable om man inte vill byta bild
        ]);

        // 2. Hantera bildbytet om en ny bild har skickats med
        if ($request->hasFile('image')) {
            // (Valfritt) Ta bort den gamla bilden från servern först om du vill städa upp
            if ($post->image && \Storage::disk('public')->exists($post->image)) {
                \Storage::disk('public')->delete($post->image);
            }

            // Spara den nya bilden i mappen 'storage/app/public/posts'
            $path = $request->file('image')->store('posts', 'public');

            // Spara filvägen i vår validerade array som ska till databasen
            $validated['image'] = $path;
        } else {
            // Om ingen ny bild laddades upp, ta bort 'image' från arrayen så den inte skriver över med null
            unset($validated['image']);
        }

        // 3. Uppdatera posten i databasen
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
