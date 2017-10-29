<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\Post;

class PriceAlertViewComposer
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
        $price_alert_posts = cache()->remember('price_alert_posts', 60, function () {
            return Post::latest()
                       ->whereIn('category_id', [2, 3])
                       ->limit(10)
                       ->get();
        });

        $view->with(compact('price_alert_posts'));
    }
}
