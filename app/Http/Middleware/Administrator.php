<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // auth('api')->user()->type ='admin'
        if (auth('api')->user()) {
            // return $next($request);
            return auth('api')->user();
        }

        // abort(403, 'You do not have permission to perform this action.');
    }
}
