<?php

namespace App\Http\Middleware\Feature;

use Closure;

/**
 * 機能スイッチ：世界
 *
 * Class World
 * @package App\Http\Middleware
 */
class World
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
        if (!config('amazon-feature.world')) {
            return abort(404);
        }

        return $next($request);
    }
}
