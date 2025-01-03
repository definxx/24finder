<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;

class ItemDislikedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Item $item, User $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Your Item has been Disliked')
                    ->view('emails.item_disliked'); // Create a Blade view for the email content
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Item Disliked Notification',
        );
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
