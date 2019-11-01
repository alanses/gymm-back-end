<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Entities\PaymentPlan;
use App\Modules\Payment\Service\CloudPaymentsService;
use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class SendPayment extends AbstractTask
{
    /**
     * @var CloudPaymentsService
     */
    private $cloudPaymentsService;
    private $paymentResponse;

    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
        $this->paymentResponse = null;
    }

    public function run()
    {
        return $this->paymentResponse;
    }

    public function makeSubscribe(Plan $plan, string $cryptID, User $user)
    {
        $this->paymentResponse = json_decode($this->cloudPaymentsService->makePaymentSubscribe($plan, $cryptID, $user));

        return $this;
    }

    public function makePayment(PaymentPlan $paymentPlan, string $cryptID, User $user)
    {
        $this->paymentResponse = json_decode($this->cloudPaymentsService->makePayment($paymentPlan, $cryptID, $user));

        return $this;
    }
}
