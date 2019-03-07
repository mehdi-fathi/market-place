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

        Route::group(['middleware' => 'auth:api'], function () {


            Route::prefix('seller')->group(function () {

                Route::group([
                    'middleware' => [\Apps\User\Http\Middlewares\Permission::class .
                        ":seller-users"]
                ], function () {

                    Route::post('products/create',
                        '\Apps\Product\Http\Controllers\Api\Seller\ProductsController@createProduct'
                    );
                    Route::post('markets/create',
                        '\Apps\Product\Http\Controllers\Api\Seller\MarketsController@createStore'
                    );

                });

            });


        });

    });

});
