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
    Route::delete('admin/user/{id}', 'UsersController@deleteUser');

    Route::get('admin/gyms', 'GymsController@getGyms');
    Route::get('admin/gyms/{id}', 'GymsController@getGym');
});
