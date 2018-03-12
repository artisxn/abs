<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\User;

class UserCountViewComposer
{
    /**
     * データをビューと結合
     *
     * @param  View $view
     *
     * @return void
     *
     * @throws \Exception
     */
    public function compose(View $view)
    {
        $user_count = cache()->remember('user_count', 60, function () {
            return User::count();
        });

        $view->with(compact('user_count'));
    }
}
