<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Model\Post;

class PickupViewComposer
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
        //        $pickup_posts = cache()->remember('pickup_posts', 60, function () {
        //            return Post::pickup()->get();
        //        });

        $pickup_posts = Post::pickup()->get();

        $view->with(compact('pickup_posts'));
    }
}
