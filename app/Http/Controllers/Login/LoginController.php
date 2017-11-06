<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Socialite;

use App\Model\User;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('amazon')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            return redirect('/');
        }

        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver('amazon')->user();

        /**
         * @var \App\Model\User $loginUser
         */
        $loginUser = User::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'name'          => $user->name,
                'email'         => $user->email,
                'user_id'       => $user->id,
                'access_token'  => $user->token,
                'refresh_token' => $user->refreshToken,
                'api_token'     => str_random(60),
            ]);

        auth()->login($loginUser, true);

        session(['guest_login' => false]);

        return view('auth.callback');
    }

    public function logout()
    {
        auth()->logout();

        if (session('guest_login')) {
            return redirect()->route('auth.login.form');
        }

        return redirect('/');
    }
}
