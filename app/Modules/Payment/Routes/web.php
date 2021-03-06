<?php

Route::get('subscribe', 'SubscribePaymentController@subscribePaymentForm');
Route::post('confirm/subscribe', 'SubscribePaymentController@confirmSubscribe');

Route::get('payment', 'PaymentController@paymentForm');
Route::post('confirm/payment', 'PaymentController@confirmPayment');

Route::get('crypt/payment', 'PaymentController@paymentCryptForm');
Route::get('crypt/subscribe', 'SubscribePaymentController@subscribeCryptForm');
