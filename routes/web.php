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

Route::get('asin/{asin}', 'AmazonController@asin');
Route::get('browse/{browse}', 'AmazonController@browse');
Route::get('browse', 'AmazonController@browseList');
Route::get('search', 'AmazonController@search');

Route::get('/', 'AmazonController@index');
