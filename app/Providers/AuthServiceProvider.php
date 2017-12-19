<?php

namespace shiraishi\Providers;

use shiraishi\Product;
use Laravel\Horizon\Horizon;
use shiraishi\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Horizon::auth(function ($request) {
            return $this->app->environment('local') || ($request->user() && $request->user()->id === 1);
        });
    }
}
