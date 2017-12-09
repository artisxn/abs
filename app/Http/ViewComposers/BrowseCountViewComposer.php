<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class BrowseCountViewComposer
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
        $browses_count = cache()->get('browses_count');

        $view->with(compact('browses_count'));
    }
}
