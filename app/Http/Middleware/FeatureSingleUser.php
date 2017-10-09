<?php

namespace App\Http\Middleware;

use Closure;

/**
 * 機能スイッチ：シングルユーザー
 *
 * @package App\Http\Middleware
 */
class FeatureSingleUser
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
        if (config('amazon-feature.single_user') and auth()->check()) {
            if (auth()->user()->id != config('amazon-feature.single_user_id')) {
                abort(404);
            }
        }

        return $next($request);
    }
}
