<?php

namespace App\Providers;

use App\ExternalApi\Cro\CroApi;
use App\ExternalApi\Cro\CroApiContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CroApiContract::class, CroApi::class);
    }
}
