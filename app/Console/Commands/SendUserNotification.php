<?php
// In app/Console/Commands/SendUserNotification.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\NotifyUsers;
use Illuminate\Support\Facades\Mail;

class SendUserNotification extends Command
{
    protected $signature = 'email:notify-users';

    protected $description = 'Send notification email to all users.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get all users
        $users = User::all();

        // Iterate through each user and send the email
        foreach ($users as $user) {
            // Pass the user object to the mailable
            Mail::to($user->email)->send(new NotifyUsers($user));  // Pass the user object
        }

        $this->info('Notification emails sent to all users!');
    }
}
