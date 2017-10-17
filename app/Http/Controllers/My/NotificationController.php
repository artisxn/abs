<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(10);

        $notifications->markAsRead();

        return view('notification.index')->with(compact('notifications'));
    }
}
