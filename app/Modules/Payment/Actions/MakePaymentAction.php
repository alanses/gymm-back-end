<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Http\Requests\PaymentRequest;
use App\Modules\Payment\Tasks\AddPointsToAccountTask;
use App\Modules\Payment\Tasks\CheckIfNeed3DVerificationTask;
use App\Modules\Payment\Tasks\CheckIfPaymentConfirmTask;
use App\Modules\Payment\Tasks\CheckIfTransactionRejectedTask;
use App\Modules\Payment\Tasks\GetPlanTask;
use App\Modules\Payment\Tasks\MakeSubscribeTask;
use App\Modules\Payment\Tasks\SendPaymentTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class MakePaymentAction extends AbstractAction
{
    public function run(PaymentRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $plan = $this->call(GetPlanTask::class, [], [
            ['findByField' => ['id', $this->getPlanId($request)]]
        ]);

        $cryptID = $this->getCardCryptogramPacket($request);

        $payment = $this->call(SendPaymentTask::class, [$plan, $cryptID, $user]);

        $this->call(CheckIfTransactionRejectedTask::class, [$payment]);

        $this->call(CheckIfNeed3DVerificationTask::class, [$payment]);

        $this->call(CheckIfPaymentConfirmTask::class, [$payment]);

        $this->call(AddPointsToAccountTask::class, [$plan, $user]);

        $this->call(MakeSubscribeTask::class, [$payment]);
    }

    private function getCardCryptogramPacket(PaymentRequest $request)
    {
        return $request->CardCryptogramPacket;
    }

    private function getPlanId(PaymentRequest $request)
    {
        return $request->plan_id;
    }
}
