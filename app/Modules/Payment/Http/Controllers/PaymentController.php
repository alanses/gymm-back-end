<?php

namespace App\Modules\Payment\Http\Controllers;

use App\Ship\Parents\ApiController;
use Illuminate\Support\Facades\Log;

class PaymentController extends ApiController
{
    public function testPayment()
    {
        return view('paymenttest');
    }

    public function testPaymentConfirm()
    {
        Log::info('qwerty');
    }
}
