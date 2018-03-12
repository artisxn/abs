<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class HistoryCountViewComposer
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
        $histories_count = cache('histories_count', '0');

        $view->with(compact('histories_count'));
    }
}
