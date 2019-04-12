<?php

namespace App\Providers;

use App\Events\DentistCreated;
use App\Events\DentistUpdated;
use App\Listeners\CheckCro;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
//        DentistCreated::class => [
//            CheckCro::class
//        ],

    ];

    protected $subscribe = [
        CheckCro::class
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
