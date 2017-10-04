<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ItemCountViewComposer
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
        $items_count = cache()->get('items_count');

        $view->with(compact('items_count'));
    }
}
