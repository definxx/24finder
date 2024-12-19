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

class ItemCommentedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $item;
    public $user;   // The user who commented
    public $comment;

    /**
     * Create a new message instance.
     */
    public function __construct(Item $item, User $user, Comment $comment)
    {
        $this->item = $item;
        $this->user = $user;   // Store the user who commented
        $this->comment = $comment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Item Commented Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        // Make sure to pass the variables (item, user, comment) to the view
        return $this->subject('Your Item has been Commented on')
                    ->view('emails.item_commented') // Create a Blade view for the email content
                    ->with([
                        'item' => $this->item,
                        'user' => $this->user,
                        'comment' => $this->comment,
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
