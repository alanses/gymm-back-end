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

Route::post('registration/user', 'UserController@createUser');
Route::post('registration/gym', 'UserController@createGym');

Route::middleware('auth:api')->group(function () {
    Route::get('users/{id}', 'UserController@getUserById');
});
