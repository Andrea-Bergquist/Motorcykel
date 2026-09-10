<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsSection extends Component
{
    public $body = '';
    public $guest_name = '';

    // Valideringsregler
    protected function rules()
    {
        return [
            'body' => 'required|min:3|max:1000',
            // Kräv namn om användaren INTE är inloggad
            'guest_name' => Auth::check() ? 'nullable' : 'required|min:2|max:50',
        ];
    }

    public function saveComment()
    {
        $this->validate();
        Comment::create([
            'user_id' => Auth::id(), // Blir null om gäst
            'guest_name' => Auth::check() ? null : $this->guest_name,
            'body' => $this->body,
        ]);
        // Rensa fälten efteråt
        $this->reset(['body', 'guest_name']);

        // Skicka en notis till sessionen (valfritt)
        session()->flash('message', 'Kommentaren har skickats!');
    }
    
    public function render()
    {
        // Hämta de senaste kommentarerna
        $comments = Comment::with('user')->latest()->get();
        return view('livewire.comments-section', [
            'comments' => $comments
        ]);
    }
}
