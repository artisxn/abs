<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ItemCountViewComposer
{
    /**
     * @param View $view
     *
     * @throws \Exception
     */
    public function compose(View $view)
    {
        $items_count = cache('items_count', '0');

        $view->with(compact('items_count'));
    }
}
