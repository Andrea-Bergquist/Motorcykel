namespace App\Mail;

use App\Models\Post; // Importöser din Post-modell
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // Gör variabeln public så blir den automatiskt tillgänglig i din Blade-vy
    public $post;

    /**
     * Skapa en ny mailable-instans.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nytt inlägg på MC Bloggen: ' . $this->post->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.published',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
