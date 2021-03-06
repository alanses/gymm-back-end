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
    Route::post('create/trainer', 'TrainerController@addTrainer');
    Route::get('trainer/{id}', 'TrainerController@getTrainerById');
    Route::get('list/trainers/for/select', 'TrainerController@getListTrainersForSelect');
    Route::get('gym/trainers', 'TrainerController@getListTrainerForProfile');
    Route::get('schedule/trainer/{id}', 'TrainerController@getTrainerSchedule');

    Route::get('list/gyms', 'GymController@getListGyms');
    Route::get('gym/{id}', 'GymController@getGym');
    Route::get('gym-info', 'GymController@getGymInfo');

    Route::delete('trainer/{id}', 'TrainerController@deleteTrainer');
});
