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

Route::get('/', ['as' => 'home', 'uses' => 'DefaultController@home']);

Route::get('events/attend/{event}', ['as' => 'event.attend', 'uses' => 'EventController@attend']);
Route::get('events/approve/{event}', ['as' => 'event.approve', 'uses' => 'EventController@approve']);
Route::get('events/destroy/{event}', ['as' => 'event.destroy', 'uses' => 'EventController@destroy']);
Route::get('events/reject/{event}', ['as' => 'event.reject', 'uses' => 'EventController@reject']);
Route::get('events/{name}/{event}', ['as' => 'event.show', 'uses' => 'EventController@show']);
Route::get('events/create', ['as' => 'event.create', 'uses' => 'EventController@create']);
Route::post('events/store', ['as' => 'event.store', 'uses' => 'EventController@store']);
Route::post('events/invite', ['as' => 'event.invite', 'uses' => 'EventController@invite']);

Route::get('users/load', ['as' => 'user.load', 'uses' => 'UserController@load']);