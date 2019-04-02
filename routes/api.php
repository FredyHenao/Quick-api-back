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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('all', 'UserController@user');
    Route::get('show/{id?}', 'UserController@userShow');
    Route::delete('delete/{id?}', 'UserController@userDelete');
    Route::put('update/{id?}', 'UserController@userUpdate');
});
