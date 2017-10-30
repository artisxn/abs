<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('Api')->group(function () {
    Route::get('graph/{asin}', 'HistoryGraphController');
});

Route::namespace('Api\World')->middleware(['auth:api', 'world'])->group(function () {
    Route::name('api.world.index')->get('world', 'WorldIndexController');

    Route::name('api.world.show.asin')->get('world/asin/{asin}', 'WorldShowController@asin');
    Route::name('api.world.show.ean')->get('world/ean/{ean}', 'WorldShowController@ean');

    Route::name('api.world.update')->any('world/update', 'WorldUpdateController');
    Route::name('api.world.new')->get('world/new', 'WorldNewController');
});

Route::namespace('Api\Watch')->middleware(['auth:api'])->group(function () {
    Route::post('watch/asin', 'AsinController@store');
    Route::post('watch/ean', 'EanController@store');
});
