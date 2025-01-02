<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\DataForm;  
use Illuminate\Support\Facades\Mail;

class NotifyUserSurvey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'app:notify-user-survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User survey notification';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new DataForm($user)); 
        }
    }
}
