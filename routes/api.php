<?php

use Dingo\Api\Routing\Router;

$api = app('api.router');

$api->version('v1', ['namespace' => 'shiraishi\Http\Controllers'], function ($api) {
    /** @var $api \Dingo\Api\Routing\Router */

    $api->post('login', 'Auth\ApiController@login');

    $api->group(['middleware' => 'api.auth'], function (Router $api) {
        $api->post('logout', 'Auth\ApiController@logout');
        $api->post('refresh', 'Auth\ApiController@refresh');
        $api->get('me', 'Auth\ApiController@me');
    });

});
