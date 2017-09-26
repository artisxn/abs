<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\Item;

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
        $items_count = cache()->remember('items_count',     0, function () {
            return Item::count('asin');
        });

        $view->with(compact('items_count'));
    }
}
