<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\Browse;

class BrowseCountViewComposer
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
        $browses_count = cache()->remember('browses_count', 60, function () {
            return Browse::count('id');
        });

        $view->with(compact('browses_count'));
    }
}
