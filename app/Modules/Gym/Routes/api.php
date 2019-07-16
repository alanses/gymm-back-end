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

Route::post('create/trainer', 'GymControllerController@addTrainer');
Route::get('trainer/{id}', 'GymControllerController@getTrainerById');
Route::get('list/trainers/select/by/user/id/{id}', 'GymControllerController@getListTrainersForSelect');
