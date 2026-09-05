<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\NewsletterSubscription;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    //Tar fram alla inlägg och visar dem på startsidan
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->paginate(5);

        return view('welcome', compact('posts'));
    }

    //Tar fram ett specifikt inlägg baserat på dess ID och visar det på en separat sida
    public function show($id)
    {
        $post = Post::with('images')->findOrFail($id);

        return view('content', compact('post'));
    }

    // Tar emot en prenumerationsförfrågan och sparar e-postadressen i databasen
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|unique:newsletter_subscribers,email',
        ], [
            'email.email' => 'Vänligen ange en giltig e-postadress.',
            'email.unique' => 'Denna e-postadress prenumererar redan.',
        ]);

        // Save the email to the newsletter subscriptions table
        NewsletterSubscriber::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Tack för att du prenumererar på vårt nyhetsbrev!');
    }

    //Send a email for the newsletter
    public function sendMail()
    {
        Mail::to('andreabergquist@msn.com')->queue(new NewsletterMail());

        return redirect()->back()->with('success', 'E-post skickad!');

    }
}
