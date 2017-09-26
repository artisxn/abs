<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\History;

class HistoryCountViewComposer
{
    /**
     * データをビューと結合
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $histories_count = cache()->remember('histories_count', 10, function () {
            return History::count('id');
        });

        $view->with(compact('histories_count'));
    }
}
