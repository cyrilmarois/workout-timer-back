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


Route::middleware('auth:api')->prefix('user')->group(function() {
    Route::post('/', 'UserController@store');
    Route::get('/', 'UserController@index');
    Route::get('/{id}', 'UserController@show');
    Route::patch('/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
});

Route::prefix('timer')->group(function() {
    Route::post('/', 'TimerController@store');
    Route::get('/', 'TimerController@index');
    Route::get('/{id}', 'TimerController@show');
    Route::patch('/{id}', 'TimerController@update');
    Route::delete('/{id}', 'TimerController@destroy');
    Route::patch('/{id}/set', 'TimerController@addSet');
    Route::delete('/{id}/set', 'TimerController@removeSet');
});

Route::prefix('set')->group(function() {
    Route::post('/', 'SetController@store');
    Route::get('/', 'SetController@index');
    Route::get('/{id}', 'SetController@show');
    Route::patch('/{id}', 'SetController@update');
    Route::delete('/{id}', 'SetController@destroy');
});

Route::fallback('HodorController');
