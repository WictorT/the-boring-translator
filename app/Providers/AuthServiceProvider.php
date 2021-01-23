<?php

namespace App\Providers;

use App\Auth\TokenGuard;
use App\Auth\UserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('app_users', function ($app, array $config) {
            return new UserProvider($this->app['hash'], $config['model']);
        });

        Auth::extend('app_token', function ($app, $name, array $config) {
            return new TokenGuard(
                Auth::createUserProvider($config['provider'] ?? null),
                $this->app['request']
            );
        });
    }
}
