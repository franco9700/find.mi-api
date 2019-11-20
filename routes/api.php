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

        //Users providers routes
        $api->resource('users-providers')->relationships(function ($relations) {
            $relations->hasOne('user');
            $relations->hasMany('providers-commentaries');
        });

        //Services catalogues routes
        $api->resource('services-catalogues')->relationships(function ($relations) {
            $relations->hasMany('services-sub-catalogues');
        });

        //Services subcatalogues routes
        $api->resource('services-sub-catalogues')->relationships(function ($relations) {
            $relations->hasOne('services-catalogue');
        });

        //Jobs statuses routes
        $api->resource('jobs-statuses')->relationships(function ($relations) {
            $relations->hasMany('jobs');
        });

        //Providers commentaries routes
        $api->resource('providers-commentaries')->relationships(function ($relations) {
            $relations->hasOne('user');
            $relations->hasOne('users-provider');

        });


	});
});
