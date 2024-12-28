<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\NewItemAdded;
use App\Listeners\SendNewItemNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<class-string>>
     */
    protected $listen = [
        NewItemAdded::class => [
            SendNewItemNotification::class,
        ],
        \App\Events\UserAction::class => [
            \App\Listeners\AwardReferralPoints::class,
        ],
    ];

    /**
     * Register any events for the application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
