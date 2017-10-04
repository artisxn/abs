<?php

namespace App\Http\Controllers\Featured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\User;

class TaskUserController extends Controller
{
    public function __invoke()
    {
        $users = User::latest()->where('id', '>', 3)->with('watches')->get();

        return view('featured.task')->with(compact('users'));
    }
}
