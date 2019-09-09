<?php

namespace App\ExternalApi\Rede;

use Carbon\Laravel\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use Rede\eRede;
use Rede\Store;

class RedeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Rede::class, function () {
            $mode = config('rede.mode');
            $pv = config('rede.pv');
            $token = config('rede.token');

            \Log::debug("Criando provider da Rede: modo: $mode, PV: $pv, Token: $token");

            $store = new Store($pv, $token, $mode === 'production' ? \Rede\Environment::production() : \Rede\Environment::sandbox());
            $handler = new eRede($store);

            return new Rede($handler);
        });
    }
}
