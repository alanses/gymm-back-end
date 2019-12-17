<?php

namespace App\Modules\Payment\Http\Controllers;

use App\Exceptions\Need3DVerificationException;
use App\Modules\Payment\Actions\ConfirmSubscribeAction;
use App\Modules\Payment\Actions\MakeSubscribeAction;
use App\Modules\Payment\Actions\RegisterUserSubscribeAction;
use App\Modules\Payment\Actions\UnFollowSubscribeAction;
use App\Modules\Payment\Http\Requests\SubscribeCryptRequest;
use App\Modules\Payment\Http\Requests\SubscribeRequest;
use App\Modules\Payment\Transformers\PaymentTransformer;
use App\Modules\Payment\Transformers\ValidationSubscribe3DTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class SubscribePaymentController extends ApiController
{
    public function subscribe(SubscribeRequest $request)
    {
        try {
            $payment = $this->call(MakeSubscribeAction::class, [$request]);

            return new PaymentTransformer($payment);

        } catch (Need3DVerificationException $exception) {
            return new ValidationSubscribe3DTransformer($exception->getData());
        }
    }

    public function subscribeCryptForm(SubscribeCryptRequest $request)
    {
        return view('payment::subscribes.subscribes-crypt');
    }

    public function subscribePaymentForm(Request $request)
    {
        return view('payment::subscribes.subscribe', [
            'PaReq' => base64_decode($request->PaReq),
            'AcsUrl' => base64_decode($request->AcsUrl),
            'MD' => base64_decode($request->MD),
        ]);
    }

    public function confirmSubscribe(Request $request)
    {
        $subscribe = $this->call(ConfirmSubscribeAction::class, [$request]);

        $this->call(RegisterUserSubscribeAction::class, [$subscribe]);

        return view('payment::subscribes.confirm-subscribe');
    }

    public function makeUnFollowSubscribe()
    {
        $this->call(UnFollowSubscribeAction::class);

        return $this->success();
    }
}
