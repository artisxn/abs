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

//ホーム
Route::name('index')->get('/', 'AmazonController');

//ASIN
Route::namespace('Asin')->group(function () {
    Route::redirect('asin', '/');
    Route::name('asin')->get('asin/{asin}', 'ItemController')
         ->where('asin', '[0-9a-zA-Z]{10}');
});

//ブラウズ
Route::namespace('Browse')->group(function () {
    Route::name('browse')->get('browse/{browse}', 'BrowseController')
         ->where('browse', '[0-9]+');
    Route::name('browse-new')->get('browse/{browse}/new', 'BrowseNewController')
         ->where('browse', '[0-9]+');
});

//ブラウズリスト
Route::namespace('BrowseList')->group(function () {
    Route::name('browselist')->get('browse', 'BrowseListController');
    Route::name('browselist-all')->get('browse-all', 'BrowseListAllController');
});

//検索
Route::name('search')->get('search', 'SearchController');


//ログイン
Route::namespace('Login')->group(function () {
    Route::name('login')->get('login', 'LoginController@login');
    Route::get('callback', 'LoginController@callback');
    Route::name('logout')->get('logout', 'LoginController@logout');
});

//ユーザーページ
Route::middleware('auth')->namespace('My')->group(function () {
    Route::name('notifications')->get('notifications', 'NotificationController');
    Route::resource('settings', 'SettingController')
         ->only(['index', 'store']);
});

//ウォッチリスト
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

    Route::name('watch')->get('/', 'WatchController');
});

//インポート
Route::middleware('auth')->prefix('import')->namespace('Import')->group(function () {
    Route::name('import.jan')->post('jan', 'JanImportController');
    Route::name('import.asin')->post('asin', 'AsinImportController');

    Route::view('/', 'import.index')->name('import.index');
});

//CSVダウンロード
Route::middleware('auth')->namespace('Download')->group(function () {
    Route::name('download.asin')->get('download/asin', 'AsinController');
    Route::name('download.category')->get('download/category/{category}', 'CategoryController');

    Route::name('download.csv')->get('download/csv/{file_name}', 'CsvController');

    Route::name('export.index')->get('export', 'ExportController@index');
    Route::name('export.export')->post('export', 'ExportController@export');
});

//ワールド
Route::namespace('World')->middleware(['auth', 'world'])->group(function () {
    Route::name('world.new')->get('world/new', 'WorldNewController');
    Route::name('world.api')->get('world/api', 'WorldApiController');

    Route::resource('world', 'WorldController')
         ->only(['index', 'show']);
});

//Password Login
Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('login', 'LoginController@showLoginForm')->name('auth.login.form');
    Route::post('login', 'LoginController@login')->name('auth.login.post');
});

//WebPush
Route::namespace('Push')->prefix('push')->group(function () {
    Route::get('notifications/last', 'NotificationController@last');
    Route::post('notifications/{id}/dismiss', 'NotificationController@dismiss');

    Route::post('subscriptions', 'PushSubscriptionController@update');
    Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');
});

//Voyager
Route::middleware('can:admin-voyager')->prefix('admin')->group(function () {
    Voyager::routes();
});

//特集
Route::namespace('Feature')->prefix('feature')->group(function () {
    Route::name('feature.game')->get('game', 'Game\GameController');
});


if (config('feature.plan')) {
    Route::view('plan', 'pages.plan')->name('plan');
}
Route::view('privacy', 'pages.privacy')->name('privacy');
Route::view('usage', 'pages.usage')->name('usage');
Route::view('closed', 'pages.closed')->name('closed');
Route::view('docs/api', 'docs.api')->name('docs.api');
