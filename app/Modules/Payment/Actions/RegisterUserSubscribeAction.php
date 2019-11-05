<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\MakeSettingBonusToAccountTask;
use App\Modules\Payment\Tasks\RemoveOldSubscribeSubTask;
use App\Modules\Plans\Tasks\GetPlanTask;
use App\Modules\Plans\Tasks\SubscribeUserToPlanTask;
use App\Modules\Transactions\Tasks\RegisterSubscribeToHistoryTask;
use App\Modules\Transactions\Tasks\RegisterTransactionTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;
use stdClass;

class RegisterUserSubscribeAction extends AbstractAction
{
    public function run(stdClass $subscribe)
    {
        $user = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $this->getUserEmailOrLogin($subscribe)]],
            ['whereLoginIs' => ['login', $this->getUserEmailOrLogin($subscribe)]]
        ]);

        $plan = $this->call(GetPlanTask::class, [], [
            ['findByField' => ['payment_for_month', $this->getPayment($subscribe)]]
        ]);

        $this->call(RemoveOldSubscribeSubTask::class, [$user]);

        $this->call(SubscribeUserToPlanTask::class, [$plan, $user]);

        $this->call(RegisterSubscribeToHistoryTask::class, [$plan, $user, $subscribe]);

        $this->call(RegisterTransactionTask::class, [$user], [
            ['addPoints' => [$user, $plan]],
            ['setPointsFromPlan' => [$plan]],
            ['setOperationType' => ['add']]
        ]);

        $this->call(MakeSettingBonusToAccountTask::class, [$user, $plan, $subscribe]);
    }

    private function getUserEmailOrLogin(stdClass $subscribe)
    {
        return $subscribe->Model->AccountId;
    }

    private function getPayment(stdClass $subscribe)
    {
        return $subscribe->Model->Amount;
    }
}
