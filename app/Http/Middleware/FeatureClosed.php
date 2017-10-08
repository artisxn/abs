<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 機能スイッチ：非公開
 *
 * Class FeatureClosed
 * @package App\Http\Middleware
 */
class FeatureClosed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('amazon-feature.closed') and auth()->check() === false) {
            if (!$request->is('login') and !$request->is('callback')) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
