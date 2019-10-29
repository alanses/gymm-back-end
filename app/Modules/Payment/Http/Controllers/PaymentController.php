<?php

namespace App\Modules\Payment\Http\Controllers;

use App\Exceptions\Need3DVerificationException;
use App\Modules\Payment\Actions\ConfirmPaymentAction;
use App\Modules\Payment\Actions\MakePaymentAction;
use App\Modules\Payment\Http\Requests\PaymentRequest;
use App\Modules\Payment\Service\CloudPaymentsService;
use App\Modules\Payment\Transformers\Validation3DTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class PaymentController extends ApiController
{
    public function testingConnect(CloudPaymentsService $cloudPaymentsService)
    {
        $request = $cloudPaymentsService->testConnect();

        return $this->success($request);
    }

    public function makePayment(PaymentRequest $request)
    {
        try {
            $payment = $this->call(MakePaymentAction::class, [$request]);

            return $payment;

        } catch (Need3DVerificationException $exception) {
            return new Validation3DTransformer($exception->getData());
        }
    }

    public function paymentForm(Request $request)
    {
        return view('payment', [
            'PaReq' => base64_decode($request->PaReq),
            'AcsUrl' => base64_decode($request->AcsUrl),
            'MD' => base64_decode($request->MD),
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $this->call(ConfirmPaymentAction::class, [$request]);

        return view('confirm-payment');
    }
}
