<?php

namespace App\Providers;

use App\Policies\SalonPolicy;
use App\User;
use App\Salon;

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
        User::class => Salon::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-salon', 'App\Policies\SalonPolicy@view');
        Gate::define('edit-salon', 'App\Policies\SalonPolicy@edit');
    }
}
