<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function build()
    {
        // Get the first image from JSON for attachment
        $imagePath = asset('https://24finder.ng/storage/app/public/' . json_decode($this->item->images)[0]);

        return $this->view('emails.product')
            ->subject('Check out our latest product!')
            ->with(['item' => $this->item, 'imagePath' => $imagePath])
            ->attach(storage_path('app/public/' . json_decode($this->item->images)[0]));
    }
}
