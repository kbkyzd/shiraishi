<?php

if (! function_exists('api_route')) {
    function api_route($route, $params = null)
    {
        if ($params) {
            return app('api.url')->version('v1')->route($route, $params);
        }

        return app('api.url')->version('v1')->route($route);
    }
}
