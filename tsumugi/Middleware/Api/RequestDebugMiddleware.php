<?php

namespace tsumugi\Middleware\Api;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestDebugMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('production')) {
            return $next($request);
        }

        return tap($next($request), function () use ($request) {
            Log::debug('Request', [
                'request' => $request,
            ]);
        });
    }
}
