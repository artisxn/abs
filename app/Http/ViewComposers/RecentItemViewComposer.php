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
        $recent_items = cache()->remember('recent_items', 10, function () {
            $items = Item::latest('updated_at')
                         ->whereHas('browses', function ($query) {
                             $query->whereNotIn('browse_id', config('amazon.recent_except', []));
                         })
                         ->take(15)
                         ->get();

            return $items;
        });

        $view->with(compact('recent_items'));
    }
}
