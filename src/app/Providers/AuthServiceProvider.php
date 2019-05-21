<?php

namespace App\Providers;

use App\Policies\DomainPolicy;
use App\Policies\GlobalPolicy;
use App\Policies\MenuPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-clinic', GlobalPolicy::class . '@clinicAdmin');
        Gate::define('view-dashboard', GlobalPolicy::class . '@dashboard');
        Gate::define('view-orders', GlobalPolicy::class . '@orders');
        Gate::define('place-orders', GlobalPolicy::class . '@order');
        Gate::define('view-patients', GlobalPolicy::class . '@patients');
        Gate::define('view-dentists', GlobalPolicy::class . '@dentists');
        Gate::define('domain-aligner', DomainPolicy::class . '@aligner');
        Gate::define('domain-solutions', DomainPolicy::class . '@solutions');

    }
}
