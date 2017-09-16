<?php

namespace App\Http\Middleware;

use Closure;

class Redirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (app()->environment('production') and $request->getHost() === config('amazon.redirect_from')) {
            return redirect()->away(config('amazon.redirect_to'));
        }

        return $next($request);
    }
}
