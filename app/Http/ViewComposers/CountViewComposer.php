<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class CountViewComposer
{
    /**
     * @param View $view
     *
     * @throws \Exception
     */
    public function compose(View $view)
    {
        $items_count = cache('items_count', '0');
        $browses_count = cache('browses_count', '0');
        $histories_count = cache('histories_count', '0');
        $user_count = cache('user_count', '0');

        $view->with(compact([
            'items_count',
            'browses_count',
            'histories_count',
            'user_count',
        ]));
    }
}
