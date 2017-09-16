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
        if ($request->getHost() === config('amazon.redirect_from')) {
            return redirect()->away(config('amazon.redirect_to') . $request->getRequestUri());
        }

        return $next($request);
    }
}
