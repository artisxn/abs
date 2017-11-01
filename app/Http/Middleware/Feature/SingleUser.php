<?php

namespace App\Http\Middleware\Feature;

use Closure;

/**
 * 機能スイッチ：シングルユーザー
 *
 * @package App\Http\Middleware
 */
class SingleUser
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
        if (config('feature.single_user')) {
            if (auth()->check()) {
                if (auth()->user()->id != config('feature.single_user_id')) {
                    abort(404);
                }
            }
        }

        return $next($request);
    }
}
