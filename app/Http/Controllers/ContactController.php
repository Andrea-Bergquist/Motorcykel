<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Honeypot – riktiga besökare ska aldrig fylla i detta fält.
        if ($request->filled('modell')) {
            return back()->with('success', 'Tack för ditt meddelande!');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw(
            "Namn: {$validated['name']}\n" .
                "E-post: {$validated['email']}\n\n" .
                "Meddelande:\n{$validated['message']}",
            function ($mail) use ($validated) {
                $mail->to(config('mail.contact_address'))
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject($validated['subject']);
            }
        );

        return redirect()
            ->to(url()->previous() . '#kontakt-form')
            ->with('success', 'Tack! Ditt meddelande har skickats.');
    }
}
