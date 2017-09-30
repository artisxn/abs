<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class RecentItemViewComposer
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
        $recent_items = cache()->get('recent_items');

        $view->with(compact('recent_items'));
    }
}
