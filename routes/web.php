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

Route::name('asin')->get('asin/{asin}', 'AmazonController@asin');
Route::name('browse')->get('browse/{browse}', 'AmazonController@browse');
Route::name('browselist')->get('browse', 'AmazonController@browseList');
Route::name('search')->get('search', 'AmazonController@search');

Route::name('index')->get('/', 'AmazonController@index');

Route::name('login')->get('login', 'LoginController@login');
Route::get('callback', 'LoginController@callback');
Route::name('logout')->get('logout', 'LoginController@logout');
