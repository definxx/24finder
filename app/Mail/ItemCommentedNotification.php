<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;
use App\Models\Comment;

class ItemCommentedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $user;
    public $comment;

    /**
     * Create a new message instance.
     */
    public function __construct(Item $item, User $user, Comment $comment)
    {
        $this->item = $item;
        $this->user = $user;
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
                    ->view('emails.item_commented'); // Ensure this view exists
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
