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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {
    JsonApi::register('default')->routes(function ($api) {

    	//Users routes
        $api->resource('users')->relationships(function ($relations) {
            $relations->hasOne('usersProvider');
            $relations->hasMany('providersCommentaries');
            $relations->hasMany('providersServices');
        });

	});
});
