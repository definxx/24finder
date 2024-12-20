<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ItemLikedNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $item;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($item, $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Item Liked',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('You Have a New item liked!')
            ->view('emails.item_liked.blade');
            
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
