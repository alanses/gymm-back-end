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
    Route::delete('trainer/{id}', 'TrainerController@deleteTrainer');

    Route::get('list/gyms', 'GymControllerController@getListGyms');
    Route::get('gym/{id}', 'GymControllerController@getGym');
});
