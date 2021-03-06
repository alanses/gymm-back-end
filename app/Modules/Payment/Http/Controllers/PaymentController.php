<?php

namespace App\Modules\Payment\Http\Controllers;

use App\Exceptions\Need3DVerificationException;
use App\Modules\Payment\Actions\ConfirmPaymentAction;
use App\Modules\Payment\Actions\GetListPaymentsPlansAction;
use App\Modules\Payment\Actions\MakePaymentAction;
use App\Modules\Payment\Actions\RegisterUserPaymentAction;
use App\Modules\Payment\Http\Requests\PaymentCryptFormRequest;
use App\Modules\Payment\Http\Requests\PaymentRequest;
use App\Modules\Payment\Service\CloudPaymentsService;
use App\Modules\Payment\Transformers\ListPaymentsTransformer;
use App\Modules\Payment\Transformers\PaymentTransformer;
use App\Modules\Payment\Transformers\ValidationPayment3DTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends ApiController
{
    public function payment(PaymentRequest $request)
    {
        try {
            $payment = $this->call(MakePaymentAction::class, [$request]);

            return new PaymentTransformer($payment);

        } catch (Need3DVerificationException $exception) {
            return new ValidationPayment3DTransformer($exception->getData());
        }
    }

    public function paymentCryptForm(PaymentCryptFormRequest $request)
    {
        return view('payment::payments.payment-crypt');
    }

    public function paymentForm(Request $request)
    {
        return view('payment::payments.payment', [
            'PaReq' => base64_decode($request->PaReq),
            'AcsUrl' => base64_decode($request->AcsUrl),
            'MD' => base64_decode($request->MD),
        ]);
    }

    public function confirmPayment(Request $request)
    {
        $payment = $this->call(ConfirmPaymentAction::class, [$request]);

        $this->call(RegisterUserPaymentAction::class, [$payment]);

        return view('payment::payments.confirm-payment');
    }

    public function listPaymentsPlans()
    {
        $payments = $this->call(GetListPaymentsPlansAction::class);

        return ListPaymentsTransformer::collection($payments);
    }
}
