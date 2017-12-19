<?php

use Dingo\Api\Routing\Router;

$api = app('api.router');

$api->version('v1', [
    'namespace'  => 'shiraishi\Api\Controllers',
    'middleware' => [
        'api',
        'api.throttle',
    ],
    'limit'   => 100,
    'expires' => 5,
], function (Router $api) {
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('login', 'Auth\LoginController@login');
        $api->post('refresh', 'Auth\LoginController@refresh');

        $api->group(['middleware' => 'api.auth'], function (Router $api) {
            $api->post('logout', 'Auth\LoginController@logout');
            $api->get('me', 'Auth\LoginController@me');
        });
    });

    $api->group(['middleware' => 'api.auth'], function (Router $api) {
        $api->resource('products', 'ProductController');
        $api->resource('transaction', 'TransactionController');
    });
});
