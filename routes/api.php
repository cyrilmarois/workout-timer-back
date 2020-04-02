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


Route::middleware('auth:api')->prefix('users')->group(
    function () {
        Route::post('/', 'UserController@store');
        Route::get('/', 'UserController@index');
        Route::get('/{id}', 'UserController@show');
        Route::patch('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');
    }
);

Route::prefix('timers')->group(
    function () {
        Route::post('/', 'TimerController@store');
        Route::get('/', 'TimerController@index');
        Route::get('/{id}', 'TimerController@show');
        Route::patch('/{id}', 'TimerController@update');
        Route::delete('/{id}', 'TimerController@destroy');
        Route::patch('/{id}/sets', 'TimerController@addSet');
        Route::delete('/{id}/sets/{setId}', 'TimerController@removeSet');
    }
);

Route::prefix('sets')->group(
    function () {
        Route::post('/', 'SetController@store');
        Route::get('/', 'SetController@index');
        Route::get('/{id}', 'SetController@show');
        Route::patch('/{id}', 'SetController@update');
        Route::delete('/{id}', 'SetController@destroy');
    }
);

Route::prefix('types')->group(
    function () {
        Route::get('/', 'TypeController@index');
        Route::get('/{id}', 'TypeController@show');
    }
);

Route::prefix('sounds')->group(
    function () {
        Route::post('/', 'SoundController@store');
        Route::get('/', 'SoundController@index');
        Route::get('/{id}', 'SoundController@show');
        Route::patch('/{id}', 'SoundController@update');
        Route::delete('/{id}', 'SoundController@destroy');
    }
);

Route::prefix('rounds')->group(
    function () {
        Route::post('/', 'RoundController@store');
        Route::get('/', 'RoundController@index');
        Route::get('/{id}', 'RoundController@show');
        Route::patch('/{id}', 'RoundController@update');
        Route::delete('/{id}', 'RoundController@destroy');
        Route::patch('/{id}/cycles', 'RoundController@addCycle');
        Route::delete('/{id}/cycles/{cycleId}', 'RoundController@removeCyle');
    }
);

Route::prefix('cycles')->group(
    function () {
        Route::post('/', 'CycleController@store');
        Route::get('/', 'CycleController@index');
        Route::get('/{id}', 'CycleController@show');
        Route::patch('/{id}', 'CycleController@update');
        Route::delete('/{id}', 'CycleController@destroy');
    }
);

Route::fallback('HodorController');
