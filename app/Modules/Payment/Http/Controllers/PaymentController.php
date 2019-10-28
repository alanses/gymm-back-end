<?php

namespace App\Modules\Payment\Http\Controllers;

use App\Modules\Payment\Actions\MakePaymentAction;
use App\Modules\Payment\Http\Requests\PaymentRequest;
use App\Modules\Payment\Service\CloudPaymentsService;
use App\Ship\Parents\ApiController;
use Illuminate\Support\Facades\Log;

class PaymentController extends ApiController
{
    public function testingConnect(CloudPaymentsService $cloudPaymentsService)
    {
        $request = $cloudPaymentsService->testConnect();

        return $this->success($request);
    }

    public function makePayment(PaymentRequest $request)
    {
        $payment = $this->call(MakePaymentAction::class, [$request]);

        return $payment;
    }
}
