<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\Model\User;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('amazon')->redirect();
    }

    public function callback()
    {
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
            ]);

        auth()->login($loginUser, true);

        return redirect()->route('watch');
    }

    public function logout()
    {
        auth()->logout();

        return back();
    }
}
