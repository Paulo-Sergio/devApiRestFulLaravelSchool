<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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

        Passport::routes();
        //Passport::enableImplicitGrant();

        // token sera válido por 1 hora
        Passport::tokensExpireIn(\Carbon\Carbon::now()->addHours(1));
        // token refresh válido por 20 dias
        Passport::refreshTokensExpireIn(\Carbon\Carbon::now()->addDays(20));
    }
}
