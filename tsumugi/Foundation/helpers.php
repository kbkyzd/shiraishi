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

if (! function_exists('me')) {
    /**
     * Return the current user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function me()
    {
        return auth()->user();
    }
}

if (! function_exists('toDollars')) {
    /**
     * @param float $cents
     * @return float
     */
    function toDollars($cents)
    {
        return number_format($cents / 100, 2);
    }
}
