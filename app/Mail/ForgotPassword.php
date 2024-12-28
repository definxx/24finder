<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User; // Ensure the User model is imported

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Reset Request',
        );
    }

    /**
     * Get the message content definition.
     */


    public function build()
    {
        return $this->view('emails.forgot-password')
                    ->with([
                        'user' => $this->user,
                        'resetLink' => url('/reset-password?token=' . $this->token),
                    ])
                    ->subject('Reset Your Password');
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
