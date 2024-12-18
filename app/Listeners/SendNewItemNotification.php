<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewItemAdded;
use App\Mail\NewItemNotificationMail;
use Illuminate\Support\Facades\Mail;
class SendNewItemNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewItemAdded $event)
    {
        $users = \App\Models\User::all(); // Get all users

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewItemNotificationMail(
                $event->item->title,
                $event->item->category,
                $event->item->description
            ));
        }
    }
}
