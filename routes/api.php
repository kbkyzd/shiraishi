<?php

use Dingo\Api\Routing\Router;

$api = app('api.router');

$api->version('v1', ['namespace' => 'shiraishi\Api\Controllers'], function (Router $api) {

   $api->group(['prefix' => 'auth'], function (Router $api) {

       $api->post('login', 'Auth\ApiController@login');
       $api->post('refresh', 'Auth\ApiController@refresh');

       $api->group(['middleware' => 'api.auth'], function (Router $api) {
           $api->post('logout', 'Auth\ApiController@logout');
           $api->get('me', 'Auth\ApiController@me');
        });

    });

   $api->group(['prefix' => 'transaction'], function (Router $api) {

   });

});
