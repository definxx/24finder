<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
{
    // Schedule the email notification to be sent every 1 minute
    $schedule->command('email:notify-users')->everyMinute();
    $schedule->command('app:notify-user-survey')->everyMinute();
}

    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load custom Artisan commands from the 'app/Console/Commands' directory
        $this->load(__DIR__ . '/Commands');

        // Include the console routes defined in routes/console.php
        require base_path('routes/console.php');
    }
}
