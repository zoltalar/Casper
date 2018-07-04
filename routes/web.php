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

Route::group(['prefix' => 'events'], function() {
    Route::get('/', ['as' => 'event.index', 'uses' => 'EventController@index']);
    Route::get('attend/{event}', ['as' => 'event.attend', 'uses' => 'EventController@attend']);
    Route::get('approve/{event}', ['as' => 'event.approve', 'uses' => 'EventController@approve']);
    Route::get('destroy/{event}', ['as' => 'event.destroy', 'uses' => 'EventController@destroy']);
    Route::get('reject/{event}', ['as' => 'event.reject', 'uses' => 'EventController@reject']);
    Route::get('create', ['as' => 'event.create', 'uses' => 'EventController@create']);
    Route::get('{name}/{event}', ['as' => 'event.show', 'uses' => 'EventController@show']);
    Route::post('store', ['as' => 'event.store', 'uses' => 'EventController@store']);
    Route::post('invite', ['as' => 'event.invite', 'uses' => 'EventController@invite']);
    Route::post('filter', ['as' => 'event.filter', 'uses' => 'EventController@filter']);
    Route::get('unfilter', ['as' => 'event.unfilter', 'uses' => 'EventController@unfilter']);
});

Route::get('users/load', ['as' => 'user.load', 'uses' => 'UserController@load']);