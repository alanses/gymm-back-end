<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Http\Requests\SubscribeRequest;
use App\Modules\Payment\Tasks\CheckIfNeed3DVerificationTask;
use App\Modules\Payment\Tasks\CheckIfTransactionRejectedWithOutViewTask;
use App\Modules\Payment\Tasks\MakeSubscribeTask;
use App\Modules\Payment\Tasks\RemoveOldSubscribeTask;
use App\Modules\Payment\Tasks\SendPayment;
use App\Modules\Plans\Tasks\GetPlanTask;
use App\Modules\Plans\Tasks\SubscribeUserToPlanTask;
use App\Modules\Transactions\Tasks\RegisterSubscribeToHistoryTask;
use App\Modules\Transactions\Tasks\RegisterTransactionTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class MakeSubscribeAction extends AbstractAction
{
    public function run(SubscribeRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $plan = $this->call(GetPlanTask::class, [], [
            ['findByField' => ['id', $this->getPlanId($request)]]
        ]);

        $cryptID = $this->getCardCryptogramPacket($request);

        $payment = $this->call(SendPayment::class, [], [
            ['makeSubscribe' => [$plan, $cryptID, $user]]
        ]);

        $this->call(CheckIfTransactionRejectedWithOutViewTask::class, [$payment]);

        $this->call(CheckIfNeed3DVerificationTask::class, [$payment]);

        $this->call(RemoveOldSubscribeTask::class, [$user]);

        $subscribe = $this->call(MakeSubscribeTask::class, [$payment]);

        $this->call(SubscribeUserToPlanTask::class, [$plan, $user], [
            ['whereUserIdIs' => [$user->id]]
        ]);

        $this->call(RegisterSubscribeToHistoryTask::class, [$plan, $user, $subscribe]);

        $this->call(RegisterTransactionTask::class, [$plan, $user], [
            ['addPoints' => [$user, $plan]],
            ['setOperationType' => ['add']]
        ]);

        return $payment;
    }

    private function getCardCryptogramPacket(SubscribeRequest $request)
    {
        return $request->CardCryptogramPacket;
    }

    private function getPlanId(SubscribeRequest $request)
    {
        return $request->plan_id;
    }
}
