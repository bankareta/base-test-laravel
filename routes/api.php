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

Route::group(['namespace' => 'API'], function(){
    Route::post('login', 'UserController@login');
    Route::post('refresh', 'UserController@refresh');

    Route::middleware(['auth:api-jwt'])->group(function () {
        // auth('api')->factory()->setTTL(60);
        Route::get('me', 'UserController@me');
        Route::get('refresh-token', 'UserController@refresh');
        Route::post('device', 'UserController@storeDevice');
        Route::post('logout', 'UserController@logout');
    });
});