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

Route::prefix('Api')->group(function () {

    Route::prefix('v1')->group(function () {

        Route::post('login', '\Apps\User\Http\Controllers\Api\AuthController@login');
        Route::post('register', '\Apps\User\Http\Controllers\Api\AuthController@register');
        Route::group(['middleware' => 'auth:api'], function () {

            Route::group(['middleware' => [\Apps\User\Http\Middlewares\Permission::class . ":admin-users"]], function () {

                Route::post('getUser', '\Apps\User\Http\Controllers\Api\AuthController@getUser');
            });

        });

    });

});
