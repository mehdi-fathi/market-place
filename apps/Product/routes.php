<?php

Route::prefix('Api')->group(function () {

    Route::prefix('v1')->group(function () {

        Route::group(['middleware' => 'auth:api'], function () {


            Route::prefix('seller')->group(function () {

                Route::group([
                    'middleware' => [
                        \Apps\User\Http\Middlewares\Permission::class .
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

            Route::prefix('customer')->group(function () {

                Route::group([
                    'middleware' => [\Apps\User\Http\Middlewares\Permission::class .
                        ":customer-users"]
                ], function () {

                    Route::post('products/find-near',
                        '\Apps\Product\Http\Controllers\Api\Customer\ProductsController@findNear'
                    );

                    Route::post('payment/product-buy',
                        '\Apps\Product\Http\Controllers\Api\Customer\PaymentsController@productBuy'
                    );

                });

            });


        });

    });

});
