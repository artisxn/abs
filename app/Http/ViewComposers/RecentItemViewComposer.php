<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\Item;

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
        $recent_items = cache()->remember('recent_items', 60, function () {
            return Item::latest('updated_at')->take(12)->get();
        });

        $view->with(compact('recent_items'));
    }
}
