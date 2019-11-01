<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Http\Requests\PaymentRequest;
use App\Modules\Payment\Tasks\CheckIfNeed3DVerificationTask;
use App\Modules\Payment\Tasks\CheckIfTransactionRejectedTask;
use App\Modules\Payment\Tasks\GetPaymentPlanTask;
use App\Modules\Payment\Tasks\SendPayment;
use App\Modules\Transactions\Tasks\RegisterTransactionTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class MakePaymentAction extends AbstractAction
{
    public function run(PaymentRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $paymentPlan = $this->call(GetPaymentPlanTask::class, [], [
            ['findByField' => ['id', $this->getPaymentPlanId($request)]]
        ]);

        $cryptID = $this->getCardCryptogramPacket($request);

        $payment = $this->call(SendPayment::class, [], [
            ['makePayment' => [$paymentPlan, $cryptID, $user]]
        ]);

        $this->call(CheckIfTransactionRejectedTask::class, [$payment]);

        $this->call(CheckIfNeed3DVerificationTask::class, [$payment]);

        $this->call(RegisterTransactionTask::class, [$paymentPlan, $user], [
            ['addPoints' => [$user, $paymentPlan]],
            ['setOperationType' => ['add']]
        ]);
    }

    private function getCardCryptogramPacket(PaymentRequest $request)
    {
        return $request->CardCryptogramPacket;
    }

    private function getPaymentPlanId(PaymentRequest $request)
    {
        return $request->payment_plan_id;
    }
}
