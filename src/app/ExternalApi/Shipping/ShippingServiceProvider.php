<?php

namespace App\ExternalApi\Shipping;

use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton(ShippingManagerContract::class, ShippingManager::class);
    }

}