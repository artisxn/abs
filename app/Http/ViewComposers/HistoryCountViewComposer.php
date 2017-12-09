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
        $histories_count = cache()->get('histories_count');

        $view->with(compact('histories_count'));
    }
}
