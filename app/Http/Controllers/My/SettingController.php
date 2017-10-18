<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }

    public function store(Request $request)
    {
        $request->user()->fill([
            'special_key' => $request->input('special_key'),
            'api_token'   => $request->input('api_token'),
        ])->save();

        return back();
    }
}
