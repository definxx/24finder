<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;

    /**
     * Constructor to receive product data.
     *
     * @param $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.product-notification')
                    ->subject('Check out our latest product!')
                    ->with(['product' => $this->product]);
    }
}
