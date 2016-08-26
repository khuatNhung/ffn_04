<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UpdateMatch' => [
            'App\Listeners\UpdateMatchListener',
        ],
        'App\Events\CreateBet' => [
            'App\Listeners\CreateBetListener',
        ],
        'App\Events\UserCreated' => [
            'App\Listeners\UserCreatedListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        User::created(function($user) {
            event(new UserCreated($user));
        });
    }
}
