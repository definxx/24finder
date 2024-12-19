<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\User;

class ItemLikedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The item being liked.
     *
     * @var \App\Models\Item
     */
    public $item;

    /**
     * The user who liked the item.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Item $item
     * @param \App\Models\User $user
     */
    public function __construct(Item $item, User $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Item Has Been Liked'
        );
    }

    /**
     * Build the message content definition.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Item has been Liked')
                    ->view('emails.item_liked'); // View for email content
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
