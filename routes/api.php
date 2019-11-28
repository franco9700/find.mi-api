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
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'auth:api'], function ($router){
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    JsonApi::register('default')->routes(function ($api) {

    	//Users routes
        $api->resource('users')->relationships(function ($relations) {
            $relations->hasOne('users-provider');
            $relations->hasMany('providers-commentaries');
            $relations->hasMany('providers-services');
            $relations->hasMany('jobs');
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
            $relations->hasMany('providers-services');
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

        //Providers services routes
        $api->resource('providers-services')->relationships(function ($relations) {
            $relations->hasOne('user');
            $relations->hasOne('services-sub-catalogue');
            $relations->hasMany('jobs');

        });

        //Jobs routes
        $api->resource('jobs')->relationships(function ($relations) {
            $relations->hasOne('jobs-status');
            $relations->hasOne('providers-service');
            $relations->hasOne('user');

        });


	});
});

//Media routes
Route::group([
    'prefix'     => 'api/v1/media',
    'middleware' => 'api'
], function () {

    Route::group([
        'middleware' => 'auth:api'

    ], function (){
        Route::post('upload-profile-image', 'MediaController@uploadProfileImage');
        Route::post('upload-provider-banner', 'MediaController@uploadProviderBanner');
        Route::post('upload-catalogue-image', 'MediaController@uploadCatalogueImage');

    });

        Route::get('get-profile-image/{id}', 'MediaController@getProfileImage');
        Route::get('get-provider-banner/{id}', 'MediaController@getProviderBanner');
        Route::get('get-catalogue-image/{id}', 'MediaController@getCatalogueImage');

        Route::get('thumb-profile-image/{id}/{size}', 'MediaController@thumbProfileImage');
        Route::get('thumb-provider-banner/{id}/{size}', 'MediaController@thumbProviderBanner');
        Route::get('thumb-catalogue-image/{id}/{size}', 'MediaController@thumbCatalogueImage');

        Route::get('crop-profile-image/{id}/{width}x{height}', 'MediaController@cropProfileImage');
        Route::get('crop-provider-banner/{id}/{width}x{height}', 'MediaController@cropProviderBanner');
        Route::get('crop-catalogue-image/{id}/{width}x{height}', 'MediaController@cropCatalogueImage');

        Route::get('resize-profile-image/{id}/{width}x{height}', 'MediaController@resizeProfileImage');
        Route::get('resize-provider-banner/{id}/{width}x{height}', 'MediaController@resizeProviderBanner');
        Route::get('resize-catalogue-image/{id}/{width}x{height}', 'MediaController@resizeCatalogueImage');
});
