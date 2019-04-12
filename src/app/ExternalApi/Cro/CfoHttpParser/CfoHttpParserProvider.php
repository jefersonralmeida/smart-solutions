<?php

namespace App\ExternalApi\Cro\CfoHttpParser;

use App\ExternalApi\Cro\CroApiContract;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class CfoHttpParserProvider extends ServiceProvider
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
        $this->app->singleton(CroApiContract::class, function() {
            $baseUri = config('cfoParser.baseUri');
            $baseUri .= substr($baseUri, -1, 1) != '/' ? '/' : '';
            $httpClient = new HttpClient([
                'base_uri' => $baseUri,
                'timeout' => config('cfoParser.timeout')
            ]);
            return new CroApi($httpClient, config('cro.categoryMap'));
        });
    }
}
