<?php

namespace App\Http\Controllers\Push;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notifications\WebPushTest;

class TestController extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $request->user()->notify(new WebPushTest);

        return back();
    }
}
