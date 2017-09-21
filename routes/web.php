<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('asin', 'ItemController@index');
Route::name('asin')->get('asin/{asin}', 'ItemController@show');

Route::name('browse')->get('browse/{browse}', 'BrowseController@browse');

Route::name('browselist')->get('browse', 'BrowseController@browseList');

Route::name('search')->get('search', 'SearchController@search');

Route::name('index')->get('/', 'AmazonController@index');

Route::name('login')->get('login', 'LoginController@login');
Route::get('callback', 'LoginController@callback');
Route::name('logout')->get('logout', 'LoginController@logout');

Route::middleware('auth')->group(function () {
    Route::resource('watch', 'WatchController')
         ->only(['index', 'store', 'destroy']);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
