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
    Route::get('admin/activities', 'ActivitiesController@getListActivities');
    Route::get('admin/activity/{id}', 'ActivitiesController@getActivity');
    Route::get('admin/achievements', 'AchievementController@getListAchievement');
    Route::get('admin/list/activities/for/select', 'AchievementController@getDateForCreateAchievement');
    Route::get('admin/achievement/{id}', 'AchievementController@show');

    Route::put('admin/gyms/confirm/{id}', 'GymsController@confirmGym');
    Route::put('admin/gyms/{id}', 'GymsController@updateGym');
    Route::put('admin/review/{id}', 'ReviewsController@updateReview');
    Route::put('admin/review/confirm/{id}', 'ReviewsController@confirmReview');
    Route::post('admin/update/activity', 'ActivitiesController@updateActivity');
    Route::post('admin/update/achievement', 'AchievementController@update');

    Route::delete('admin/user/{id}', 'UsersController@deleteUser');
    Route::delete('admin/activity/{id}', 'ActivitiesController@deleteActivity');
    Route::delete('admin/achievement/{id}', 'AchievementController@delete');

    Route::post('admin/review/notification', 'ReviewsController@sendEmailToAdmin');
    Route::post('admin/create/activity', 'ActivitiesController@store');
    Route::post('admin/create/achievement', 'AchievementController@store');
    Route::post('admin/slider/images', 'SliderImagesController@saveImages');
});
