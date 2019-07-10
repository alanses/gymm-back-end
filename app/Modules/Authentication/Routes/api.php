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

Route::post('login', 'AuthenticationController@login');

Route::post('login/facebook', 'LoginViaSocialNetworkController@loginViaFacebook');
Route::post('login/vkontakte', 'LoginViaSocialNetworkController@loginViaVkontacte');
Route::post('login/instagram', 'LoginViaSocialNetworkController@loginViaInstagram');
Route::post('login/google', 'LoginViaSocialNetworkController@loginViaGoogle');
