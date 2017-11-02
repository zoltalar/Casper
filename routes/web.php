<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', ['as' => 'home', 'uses' => 'PageController@home']);

Route::get('events/create', ['as' => 'event.create', 'uses' => 'EventController@create']);
Route::post('events/store', ['as' => 'event.store', 'uses' => 'EventController@store']);