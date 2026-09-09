<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\NewsletterSubscriber;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('admin.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',

            'image' => [
                'required',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,gif',
            ],

            'post_images' => [
                'nullable',
                'array',
            ],

            'post_images.*' => [
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,gif',
            ],

            'captions' => [
                'nullable',
                'array',
            ],

            'captions.*' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);


        $post = DB::transaction(function () use ($request, $validated) {

            /*
        |--------------------------------------------------------------------------
        | Huvudbild
        |--------------------------------------------------------------------------
        */

            $mainImage = $request->file('image');

            $mainFilename = Str::uuid() . '.' . $mainImage->getClientOriginalExtension();

            $mainImage->move(
                public_path('images'),
                $mainFilename
            );


            /*
        |--------------------------------------------------------------------------
        | Skapa posten
        |--------------------------------------------------------------------------
        */

            $post = Post::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'image' => $mainFilename,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Extra bilder
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('post_images')) {

                foreach ($request->file('post_images') as $index => $image) {

                    if (!$image) {
                        continue;
                    }

                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

                    $image->move(
                        public_path('images'),
                        $filename
                    );


                    $post->images()->create([
                        'image' => $filename,
                        'caption' => $request->input("captions.$index"),
                    ]);
                }
            }


            return $post;
        });

        /*
    |--------------------------------------------------------------------------
    | Skicka nyhetsbrev till alla prenumeranter (KÖAS AUTOMATISKT)
    |--------------------------------------------------------------------------
    */
        // 1. Hämta alla prenumeranters e-postadresser
        $subscribers = NewsletterSubscriber::all();

        // 2. Loopa igenom och lägg till i kön
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($post));

        }

        return redirect()
            ->route('admin.index')
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',

            'image' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,gif',
            ],

            'post_images' => [
                'nullable',
                'array',
            ],

            'post_images.*' => [
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,gif',
            ],

            'captions' => [
                'nullable',
                'array',
            ],

            'captions.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'existing_captions' => [
                'nullable',
                'array',
            ],

            'existing_captions.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'delete_images' => [
                'nullable',
                'array',
            ],

            'delete_images.*' => [
                'integer',
                'exists:post_images,id',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Uppdatera titel och innehåll
    |--------------------------------------------------------------------------
    */

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Byt huvudbild
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('image')) {

            // Ta bort gamla huvudbilden
            if (
                $post->image &&
                file_exists(public_path('images/' . $post->image))
            ) {
                unlink(public_path('images/' . $post->image));
            }


            $file = $request->file('image');

            $filename = \Illuminate\Support\Str::uuid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move(
                public_path('images'),
                $filename
            );


            $post->update([
                'image' => $filename,
            ]);
        }


        /*
    |--------------------------------------------------------------------------
    | Uppdatera captions på befintliga bilder
    |--------------------------------------------------------------------------
    */

        if ($request->has('existing_captions')) {

            foreach ($request->input('existing_captions', []) as $imageId => $caption) {

                $postImage = $post->images()
                    ->where('id', $imageId)
                    ->first();

                if ($postImage) {

                    $postImage->update([
                        'caption' => $caption,
                    ]);
                }
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Ta bort markerade bilder
    |--------------------------------------------------------------------------
    */

        if ($request->has('delete_images')) {

            foreach ($request->input('delete_images', []) as $imageId) {

                $postImage = $post->images()
                    ->where('id', $imageId)
                    ->first();

                if ($postImage) {

                    // Ta bort den fysiska filen
                    if (
                        $postImage->image &&
                        file_exists(public_path('images/' . $postImage->image))
                    ) {
                        unlink(public_path('images/' . $postImage->image));
                    }

                    // Ta bort databasraden
                    $postImage->delete();
                }
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Lägg till nya bilder
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('post_images')) {

            foreach ($request->file('post_images') as $index => $image) {

                if (!$image) {
                    continue;
                }


                $filename = \Illuminate\Support\Str::uuid()
                    . '.'
                    . $image->getClientOriginalExtension();


                $image->move(
                    public_path('images'),
                    $filename
                );


                $post->images()->create([
                    'image' => $filename,
                    'caption' => $request->input("captions.$index"),
                ]);
            }
        }


        return redirect()
            ->route('admin.index')
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
