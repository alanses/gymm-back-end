<?php

Route::get('payment', 'PaymentController@paymentForm');
Route::post('confirm/payment', 'PaymentController@confirmPayment');
