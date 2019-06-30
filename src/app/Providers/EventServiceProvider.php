<?php

namespace App\Providers;

use App\Listeners\ApproveOrderOnApi;
use App\Listeners\CheckCro;
use App\Listeners\ReproveOrderOnApi;
use App\Listeners\SendOrderToApi;
use App\Listeners\UploadOrderFiles;
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
    ];

    protected $subscribe = [
        CheckCro::class,
        UploadOrderFiles::class,
        SendOrderToApi::class,
        ApproveOrderOnApi::class,
        ReproveOrderOnApi::class,
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
