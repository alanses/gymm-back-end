<?php

if (! function_exists('applicationSubPaymentUrl')) {
    function applicationSubPaymentUrl() {
        return env('APP_URL') . 'confirm/subscribe';
    }
}

if (! function_exists('applicationPaymentUrl')) {
    function applicationPaymentUrl() {
        return env('APP_URL') . 'confirm/payment';
    }
}
