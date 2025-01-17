<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugEnvironmentExport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.debug')) {
            \DB::enableQueryLog();
        }

        return $next($request);
    }
}
