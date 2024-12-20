<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\Comment;

class ItemCommentedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $comment;


    /**
     * Create a new message instance.
     */
    public function __construct(Item $item, Comment $comment)
{
    $this->item = $item;
    $this->comment = $comment;
}


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Comment on Item!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.item_commented');
    }
    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
