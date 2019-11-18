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

Route::group([

    'middleware' => 'api',
    'prefix' => 'api/v1/auth/'

], function ($router) {

    Route::post('token', 'AuthController@token');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'auth:api'], function() {
    JsonApi::register('default')->routes(function ($api) {

    	//Users routes
        $api->resource('users')->relationships(function ($relations) {
            $relations->hasOne('users-provider');
            $relations->hasMany('providers-commentaries');
            $relations->hasMany('providers-services');
        });

        //Users providers
        $api->resource('users-providers')->relationships(function ($relations) {
            $relations->hasOne('user');
        });

	});
});
