<?php

namespace App\Http\Middleware\Feature;

use Closure;

/**
 * 機能スイッチ：パスワードログイン
 *
 * @package App\Http\Middleware
 */
class PasswordLogin
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
        if (!config('feature.password_login')) {
            return abort(404);
        }

        return $next($request);
    }
}
