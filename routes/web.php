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
Route::name('browse-new')->get('browse/{browse}/new', 'BrowseController@newRelease');

Route::name('browselist')->get('browse', 'BrowseListController@browseList');
Route::name('browselist-all')->get('browse-all', 'BrowseListController@browseAll');

Route::name('search')->get('search', 'SearchController@search');

Route::name('index')->get('/', 'AmazonController@index');

Route::name('login')->get('login', 'LoginController@login');
Route::get('callback', 'LoginController@callback');
Route::name('logout')->get('logout', 'LoginController@logout');

Route::middleware('auth')->namespace('Watch')->group(function () {
    Route::resource('asin-watch', 'AsinWatchController')
         ->only(['store', 'destroy']);

    Route::resource('browse-watch', 'BrowseWatchController')
         ->only(['store', 'destroy']);

    Route::name('watch')->get('watch', 'WatchController@index');
});

Route::middleware('auth')->namespace('Download')->group(function () {
    Route::name('download.asin')->get('download/asin', 'AsinController');
    Route::name('download.category')->get('download/category/{category}', 'CategoryController');

    Route::name('export.index')->get('export', 'ExportController@index');
    Route::name('export.export')->post('export', 'ExportController@export');
});

Route::view('privacy', 'pages.privacy')->name('privacy');
Route::view('usage', 'pages.usage')->name('usage');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
