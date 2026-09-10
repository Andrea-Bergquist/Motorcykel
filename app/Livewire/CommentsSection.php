<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\RateLimiter; // Använd Laravels inbyggda RateLimiter
use Illuminate\Validation\ValidationException;
use App\Models\Comment;

class CommentsSection extends Component
{
    public $postId;
    public string $honeypot = '';

    #[Validate('required|min:3')]
    public string $guest_name = '';

    #[Validate('required|max:500')]
    public string $body = '';

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function saveComment()
    {
        if (!empty($this->honeypot)) {
            return;
        }

        // Skapa en unik nyckel baserad på användarens IP-adress (eller session)
        $throttleKey = 'save-comment:' . request()->ip();

        // Kontrollera om användaren har överskridit gränsen (3 försök per 60 sekunder)
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            
            // Kasta ett valideringsfel som Livewire kan visa i din Blade-vy
            throw ValidationException::withMessages([
                'body' => "Du skickar kommentarer för snabbt. Vänta {$seconds} sekunder.",
            ]);
        }

        $this->validate();

        Comment::create([
            'post_id' => $this->postId,
            'guest_name' => $this->guest_name,
            'body' => $this->body,
        ]);

        // Registrera det lyckade försöket i rate limitern
        RateLimiter::hit($throttleKey, 60);

        $this->reset(['guest_name', 'body', 'honeypot']);
    }

    public function render()
    {
        return view('livewire.comments-section', [
            'comments' => Comment::where('post_id', $this->postId)->latest()->get()
        ]);
    }

    public function deleteComment($commentId)
    {
        if (auth()->check()) {
            $comment = Comment::find($commentId);
            if ($comment) {
                $comment->delete();
            }
        }
    }
}
