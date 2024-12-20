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
    public $user;

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
            subject: 'New Comment on Your Item!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Your Item Has Been Commented On')
                    ->view('emails.item_commented') // Ensure this view exists
                    ->with([
                        'item' => $this->item,
                        'comment' => $this->comment,
                    ]);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
