<?php

namespace App\Mail;

use App\Models\Item;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Item $item
     * @param User $user
     */
    public function __construct(Item $item, User $user)
    {
        $this->item = $item;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Item Available: ' . $this->item->name)
                    ->view('emails.itemNotification')
                    ->with([
                        'itemName' => $this->item->name,
                        'itemDescription' => $this->item->description,
                        'userName' => $this->user->name,
                    ]);
    }
}
