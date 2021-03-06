<?php

use Dingo\Api\Routing\Router;

$api = app('api.router');

$api->version('v1', [
    'namespace'  => 'shiraishi\Api\Controllers',
    'middleware' => [
        'api',
        'api.throttle',
    ],
    'limit'      => 200,
    'expires'    => 1,
], function (Router $api) {
    $api->get('migrate-db', function () {
        abort_if(Cache::has('recently-migrated'), 500, 'You can only migrate the DB every 10 minutes.');

        Artisan::call('migrate:fresh', [
            '--seed' => true,
        ]);

        Cache::put('recently-migrated', true, now()->addMinutes(10));

        return [
            'DB migrated!',
        ];
    });

    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->group(['middleware' => 'guest'], function (Router $api) {
            $api->post('login', 'Auth\LoginController@login')
                ->name('api.auth.login');
        });

        $api->post('refresh', 'Auth\LoginController@refresh')
            ->name('api.auth.refresh');

        $api->group(['middleware' => 'api.auth'], function (Router $api) {
            $api->post('logout', 'Auth\LoginController@logout')
                ->name('api.auth.logout');
            $api->get('me', 'Auth\LoginController@me')
                ->name('api.auth.me');
        });
    });

    $api->get('products/search', 'ProductController@search');
    $api->get('products/tags', 'ProductController@availableTags');
    $api->get('products/similar/{product}', 'ProductController@similar');
    $api->resource('products', 'ProductController');

    $api->group(['middleware' => 'api.auth'], function (Router $api) {
        $api->group(['prefix' => 'chat'], function (Router $api) {
            $api->get('/', 'ChatController@index');
            $api->get('{recipient}', 'ChatController@show')
                ->where('recipient', '[0-9]+');
            $api->post('{recipient}', 'ChatController@store')
                ->where('recipient', '[0-9]+');
        });

        $api->group(['prefix' => 'orders'], function (Router $api) {
            $api->get('/', 'OrderController@index')
                ->name('order.index');
            $api->get('{order}', 'OrderController@show')
                ->name('order.show');

            $api->group(['middleware' => ['role:root|merchant']], function (Router $api) {
                $api->post('/', 'OrderController@store')
                    ->name('order.create');
            });

            $api->post('pay/{order}', 'OrderController@pay')
                ->name('order.pay');
        });
    });
});
