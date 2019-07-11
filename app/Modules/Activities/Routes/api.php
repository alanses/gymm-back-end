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
    Route::get('list/activities/for/user', 'ActivitiesController@getAllActivities');
    Route::get('list/activities/user/{id}', 'ActivitiesController@getAllCountries');
    Route::post('activities', 'ActivitiesController@addActivitiesToUser');
});
