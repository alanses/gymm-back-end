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

Route::middleware('auth:api')->get('/userprofile', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('profile/settings', 'UserProfileController@saveSettings');
    Route::post('user/profile/save-photo', 'UserProfileController@saveUserProfileImage');
    Route::get('user/profile/settings/{id}', 'UserProfileController@getProfileSettingsByUserId');
    Route::get('user/profile', 'UserProfileController@getProfile');
});
