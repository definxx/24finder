<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailmessage;
    public $subject;
    public $name;
    public $lname;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject, $name,$lname)
    {
        $this->mailmessage = $message;
        $this->subject = $subject;
        $this->name = $name; 
        $this->lname = $lname; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome-mail',
            with: [
                'subject' => $this->subject,
                'mailmessage' => $this->mailmessage,
                'name' => $this->name,
                'lname' => $this->lname,
            ]
        );
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.welcome')
                    ->with([
                        'mailmessage' => $this->mailmessage,
                        'name' => $this->name,
                        'lname' => $this->lname,
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
