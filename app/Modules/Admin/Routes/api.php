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

Route::middleware('auth:api')->group(function () {
    Route::get('admin/users', 'UsersController@getListUsers');
    Route::get('admin/users/{id}', 'UsersController@getUserByID');
    Route::get('admin/gyms', 'GymsController@getGyms');
    Route::get('admin/gyms/{id}', 'GymsController@getGym');
    Route::get('admin/location', 'LocationController@getLocation');
    Route::get('admin/reviews', 'ReviewsController@getListReviews');
    Route::get('admin/review/{id}', 'ReviewsController@getReview');

    Route::put('admin/gyms/confirm/{id}', 'GymsController@confirmGym');
    Route::put('admin/gyms/{id}', 'GymsController@updateGym');
    Route::put('admin/review/{id}', 'ReviewsController@updateReview');
    Route::put('admin/confirm/review/{id}', 'ReviewsController@confirmReview');

    Route::delete('admin/user/{id}', 'UsersController@deleteUser');


});
