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
    Route::get('payment-connect', 'PaymentController@testingConnect');
    Route::post('subscribe', 'SubscribePaymentController@subscribe');
    Route::post('payment', 'PaymentController@payment');
    Route::delete('unfollow/subscribe', 'SubscribePaymentController@makeUnFollowSubscribe');

    Route::get('payments', 'PaymentController@listPaymentsPlans');
});
