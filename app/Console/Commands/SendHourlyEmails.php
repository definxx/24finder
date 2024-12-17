<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendHourlyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a scheduled email to all users every hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new \App\Mail\HourlyNotificationMail($user));
        }

        $this->info('Emails have been sent successfully.');
    }
}
