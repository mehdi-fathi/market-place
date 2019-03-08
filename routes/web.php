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

//Route::prefix('v1')->group(function(){
//    Route::post('login', '\Apps\User\Http\Controllers\Api\AuthController@login');
//    Route::post('register', '\Apps\User\Http\Controllers\Api\AuthController@register');
//    Route::group(['middleware' => 'auth:api'], function(){
//        Route::post('getUser', '\Apps\User\Http\Controllers\Api\AuthController@getUser');
//    });
//});

Route::get('/', function () {


//    $current_user = 1;
//    $user_id = 1;
//    $latitude = 41.366772;
//    $longitude = -72.674613;
//    $distance = 20;
//
//    $userNearestList = \Apps\Product\Model\Location::where([
//        ['latitude', '!=', $latitude],
//        ['longitude', '!=', $longitude]
//    ])->whereRaw(DB::raw("(3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) )  *
//                          cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(
//                          radians( latitude ) ) ) ) < $distance ")
//    )->get();
//    ->take(10)
//    dd($userNearestList);


    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e);
    }
    return view('welcome');
});
