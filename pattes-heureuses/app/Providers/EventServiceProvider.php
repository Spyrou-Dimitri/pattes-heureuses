<?php

namespace App\Providers;

use App\Events\VolunteerCreatedEvent;
use App\Listeners\SendVolunteerAccountMailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        VolunteerCreatedEvent::class => [
            SendVolunteerAccountMailListener::class,
        ],
    ];

    public function boot(): void
    {
    }
}
