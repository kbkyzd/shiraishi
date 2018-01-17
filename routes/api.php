<?php

use Dingo\Api\Routing\Router;

$api = app('api.router');

$api->version('v1', [
    'namespace'  => 'shiraishi\Api\Controllers',
    'middleware' => [
        'api',
        'api.throttle',
    ],
    'limit'      => 100,
    'expires'    => 5,
], function (Router $api) {
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

    $api->resource('products', 'ProductController');

    $api->group(['middleware' => 'api.auth'], function (Router $api) {
        $api->resource('transaction', 'TransactionController');

        $api->group(['prefix' => 'chat'], function (Router $api) {
            $api->get('/', 'ChatController@index');
            $api->get('{recipient}', 'ChatController@show')
                ->where('recipient', '[0-9]+');
            $api->post('{recipient}', 'ChatController@store')
                ->where('recipient', '[0-9]+');
        });
    });
});
