<?php

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
    Route::get('classes/schedule/gym', 'ClassScheduleController@getClassSchedulesForGym');
    Route::get('classes/schedule/user', 'ClassScheduleController@getClassSchedulesForUser');
    Route::get('classes/schedule/calendar', 'BookingController@getListBookingForUserCalendar');

    Route::post('classes/schedule/create', 'BookingController@createBooking');
    Route::post('classes/schedule/confirm', 'BookingController@confirmBooking');
});
