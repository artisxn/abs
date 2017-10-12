<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class AsinWatchViewComposer
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
        $asin_watches = request()->user()
                                 ->watches()
                                 ->with(['item'])
                                 ->latest()
                                 ->paginate(50)
                                 ->withPath('/watch/asin');

        $view->with(compact('asin_watches'));
    }
}
