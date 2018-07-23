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
    Route::get('/', ['as' => 'events.index', 'uses' => 'EventsController@index']);
    Route::get('attend/{event}', ['as' => 'events.attend', 'uses' => 'EventsController@attend']);
    Route::get('approve/{event}', ['as' => 'events.approve', 'uses' => 'EventsController@approve']);
    Route::get('destroy/{event}', ['as' => 'events.destroy', 'uses' => 'EventsController@destroy']);
    Route::get('reject/{event}', ['as' => 'events.reject', 'uses' => 'EventsController@reject']);
    Route::get('create', ['as' => 'events.create', 'uses' => 'EventsController@create']);
    Route::get('{name}/{event}', ['as' => 'events.show', 'uses' => 'EventsController@show']);
    Route::post('store', ['as' => 'events.store', 'uses' => 'EventsController@store']);
    Route::post('invite', ['as' => 'events.invite', 'uses' => 'EventsController@invite']);
    Route::post('filter', ['as' => 'events.filter', 'uses' => 'EventsController@filter']);
    Route::get('unfilter', ['as' => 'events.unfilter', 'uses' => 'EventsController@unfilter']);
});

Route::group(['prefix' => 'rentals'], function() {
    Route::get('/', ['as' => 'rentals.index', 'uses' => 'RentalsController@index']);
    Route::get('rent/{id}', ['as' => 'rentals.rent', 'uses' => 'RentalsController@rent']);
    Route::post('store', ['as' => 'rentals.store', 'uses' => 'RentalsController@store']);
    Route::get('invalid-dates/{car}', ['as' => 'rentals.invalid-dates', 'uses' => 'RentalsController@invalidDates']);
});

Route::get('users/load', ['as' => 'users.load', 'uses' => 'UsersController@load']);