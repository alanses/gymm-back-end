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
    Route::get('all/classes/schedule/gym', 'ClassScheduleController@getAllClassSchedulesForGym');
    Route::get('classes/schedule/user', 'ClassScheduleController@getClassSchedulesForBooking');
    Route::get('classes/schedule/calendar', 'BookingController@getListBookingForUserCalendar');
    Route::get('data/for/create/rate', 'RateController@getDataForCreateRateToClass');
    Route::get('booking/preview/{id}', 'BookingController@getBookingInfo');
    Route::get('user/passed/class', 'ClassScheduleController@getClassPassedByUser');

    Route::post('classes/schedule/create', 'BookingController@createBooking');
    Route::post('classes/schedule/confirm', 'BookingController@confirmBooking');

    Route::post('save/rate', 'RateController@saveRateToClass');
    Route::post('save/rate/full-class', 'RateController@saveRateOfClass');
    Route::put('update/rate/{id}', 'RateController@saveRateDescriptionOfClass');

    Route::delete('booking/classes/schedule/{id}', 'BookingController@removeBooking');
});
