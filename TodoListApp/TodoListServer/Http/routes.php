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
Route::group(['middleware' => 'cors'], function()
{
    Route::get('Todos/', 'TodosController@index');
    Route::options('Todos/store', 'TodosController@store');
    Route::post('Todos/store', 'TodosController@store');
    Route::options('Todos/update/{id}', 'TodosController@update');
    Route::post('Todos/update/{id}', 'TodosController@update');
    Route::options('Todos/destroy/{id}', 'TodosController@destroy');
    Route::delete('Todos/destroy/{id}', 'TodosController@destroy');
});