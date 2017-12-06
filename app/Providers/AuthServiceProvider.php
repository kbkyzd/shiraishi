<?php

namespace shiraishi\Providers;

use Laravel\Horizon\Horizon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'shiraishi\Model' => 'shiraishi\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Horizon::auth(function($request){
            return $this->app->environment('local') || ($request->user() && $request->user()->id === 1);
        });
    }
}
