<?php

namespace App\ExternalApi\Spc\Decisor;

use App\ExternalApi\Spc\SpcApiContract;
use Carbon\Laravel\ServiceProvider;

class DecisorProvider extends ServiceProvider
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
        $this->app->singleton(SpcApiContract::class, function () {

            $url = config('decisor.url');
            $user = config('decisor.user');
            $password = config('decisor.password');

            $client = new \nusoap_client($url, 'wsdl');
            $client->setCredentials($user, $password);
            $client->setHeaders([
                'Authorization', 'Basic ' . base64_encode($user . ":" . $password)
            ]);
            $client->soap_defencoding = 'UTF-8';
            $client->decode_utf8 = false;

            return new Api($client, config('decisor.productCode'));

        });
    }
}