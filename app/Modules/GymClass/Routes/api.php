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
    Route::get('gym-class/{id}', 'GymClassController@getClassScheduleForGym');
    Route::get('user-class/{id}', 'GymClassController@getClassScheduleForUser');

    Route::get('data/for/create/gym-class', 'GymClassController@getDataForCreateGymClass');
    Route::post('create/class/schedule', 'GymClassController@createClassSchedule');

    Route::get('class/schedules', 'GymClassController@getClassScheduleWithUserFilter');

    Route::delete('delete/class-schedule/{id}', 'GymClassController@deleteClassSchedule');

    Route::get('class/schedules/events/{id}', 'EventsController@getEvent');
});
