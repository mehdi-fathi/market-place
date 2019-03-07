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

            Route::get('logout', '\Apps\User\Http\Controllers\Api\AuthController@logout');

            Route::post('get-user',
                '\Apps\User\Http\Controllers\Api\AuthController@getUser'
            );

            Route::group(['middleware' => [\Apps\User\Http\Middlewares\Permission::class .
                ":admin-users,seller-users,customer-users"]], function () {


            });


            Route::prefix('admin')->group(function () {

                Route::group([
                    'middleware' => [\Apps\User\Http\Middlewares\Permission::class .
                        ":admin-users"]
                ], function () {

                    Route::post('create-seller',
                        '\Apps\User\Http\Controllers\Api\Admin\UsersController@createSeller'
                    );


                });

            });


        });

    });

});
