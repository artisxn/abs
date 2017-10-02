<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Post;

class AmazonController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pickup_posts = cache()->remember('pickup_posts', 60, function () {
            return Post::whereFeatured(true)->latest()->limit(5)->get();
        });

        return view('home.index')->with(compact('pickup_posts'));
    }
}
