<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\OrdersApiContract;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class PixsoftProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OrdersApiContract::class, function () {
            $baseUri = config('pixsoft.baseUri');
            $baseUri .= substr($baseUri, -1, 1) != '/' ? '/' : '';
            $httpClient = new HttpClient([
                'base_uri' => $baseUri,
                'timeout' => config('pixsoft.timeout')
            ]);
            return new Api($httpClient);
        });
    }
}
