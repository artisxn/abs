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


Route::redirect('asin', '/');
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

Route::middleware('auth')->prefix('watch')->namespace('Watch')->group(function () {
    Route::resource('asin', 'AsinWatchController')
         ->only(['index', 'store', 'destroy'])
         ->names([
             'index'   => 'watch.asin.index',
             'store'   => 'watch.asin.store',
             'destroy' => 'watch.asin.destroy',
         ])
         ->parameters([
             'asin' => 'asin-watch',
         ]);

    Route::resource('browse', 'BrowseWatchController')
         ->only(['index', 'store', 'destroy'])
         ->names([
             'index'   => 'watch.browse.index',
             'store'   => 'watch.browse.store',
             'destroy' => 'watch.browse.destroy',
         ])
         ->parameters([
             'browse' => 'browse-watch',
         ]);

    Route::name('watch')->get('/', 'WatchController@index');

    Route::name('watch.import')->post('import', 'ImportController');
});

Route::middleware('auth')->namespace('Download')->group(function () {
    Route::name('download.asin')->get('download/asin', 'AsinController');
    Route::name('download.category')->get('download/category/{category}', 'CategoryController');

    Route::name('export.index')->get('export', 'ExportController@index');
    Route::name('export.export')->post('export', 'ExportController@export');
});

Route::prefix('featured')->namespace('Featured')->group(function () {
    Route::name('featured.game')->get('game', 'GameController');
    Route::name('featured.task')->get('task', 'TaskUserController');
});


Route::prefix('world')->namespace('World')->group(function () {
    Route::name('world.index')->get('/', 'WorldController@index');
});


Route::view('privacy', 'pages.privacy')->name('privacy');
Route::view('usage', 'pages.usage')->name('usage');
Route::view('plan', 'pages.plan')->name('plan');


Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('auth.login.form');
    Route::post('login', 'LoginController@login')->name('auth.login.post');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
