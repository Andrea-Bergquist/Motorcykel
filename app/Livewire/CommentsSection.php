<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\RateLimit; // Importera RateLimit för Livewire 4
use App\Models\Comment;

class CommentsSection extends Component
{
    // Håller koll på vilket inlägg vi kommenterar på
    public $postId;

    // Fälla för spamrobotar (måste förbli tom)
    public string $honeypot = '';

    // Formulärfält med Livewire 4-validering direkt på attributen
    #[Validate('required|min:3')]
    public string $guest_name = '';

    #[Validate('required|max:500')]
    public string $body = '';

    // Körs när komponenten laddas in
    public function mount($postId)
    {
        $this->postId = $postId;
    }

    // Sparar kommentaren (Max 3 försök per minut för att förhindra spam)
    #[RateLimit(maxAttempts: 3, decayMinutes: 1)]
    public function saveComment()
    {
        // Om honungsfällan är ifylld är det en bot. Avbryt direkt utan felmeddelande.
        if (!empty($this->honeypot)) {
            return;
        }

        // Kör valideringen baserat på #[Validate]-attributen ovan
        $this->validate();

        Comment::create([
            'post_id' => $this->postId,
            'guest_name' => $this->guest_name,
            'body' => $this->body,
        ]);

        // Tömmer fälten efteråt, inklusive honungsfällan
        $this->reset(['guest_name', 'body', 'honeypot']);
    }

    public function render()
    {
        return view('livewire.comments-section', [
            'comments' => Comment::where('post_id', $this->postId)->latest()->get()
        ]);
    }

    // Ta bort en specifik kommentar
    public function deleteComment($commentId)
    {
        // Säkerställ att användaren faktiskt är inloggad innan radering sker
        if (auth()->check()) {
            $comment = Comment::find($commentId);

            if ($comment) {
                $comment->delete();
            }
        }
    }
}