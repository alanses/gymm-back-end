<?php

if (! function_exists('applicationPaymentUrl')) {
    function applicationPaymentUrl() {
        return env('APP_URL') . 'confirm/payment';
    }
}
