<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class RandomBrowseViewComposer
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
        $browse_items = cache('random_items');

        $view->with($browse_items);
    }
}
