<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewItemNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $itemTitle;
    public $itemCategory;
    public $itemDescription;
    /**
     * Create a new message instance.
     */
    public function __construct($title, $category, $description)
    {
        $this->itemTitle = $title;
        $this->itemCategory = $category;
        $this->itemDescription = $description;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Item Notification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
  
    public function build()
    {
        return $this->subject('New Item Available on 24Finder')
                    ->view('emails.new_item_notification')
                    ->with([
                        'itemTitle' => $this->itemTitle,
                        'itemCategory' => $this->itemCategory,
                        'itemDescription' => $this->itemDescription,
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
