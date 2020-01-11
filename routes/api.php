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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('timer')->group(function() {
    Route::post('/', 'TimerController@store');
    Route::get('/', 'TimerController@index');
    Route::get('/{id}', 'TimerController@show');
    Route::patch('/{id}', 'TimerController@update');
    Route::delete('/{id}', 'TimerController@destroy');
});

Route::fallback('HodorController@hodor');
