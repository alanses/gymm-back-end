<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\GetPaymentPlanTask;
use App\Modules\Transactions\Tasks\RegisterTransactionTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;
use stdClass;

class RegisterUserPaymentAction extends AbstractAction
{
    public function run(stdClass $payment)
    {
        $user = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $this->getUserEmailOrLogin($payment)]],
            ['whereLoginIs' => ['login', $this->getUserEmailOrLogin($payment)]]
        ]);

        $paymentPlan = $this->call(GetPaymentPlanTask::class, [], [
            ['findByField' => ['price', $this->getPayment($payment)]]
        ]);

        $this->call(RegisterTransactionTask::class, [$user], [
            ['addPoints' => [$user, $paymentPlan]],
            ['setPointsFromPlan' => [$paymentPlan]],
            ['setOperationType' => ['add']],
            ['setAmount' => [$this->getAmountFromPlan($paymentPlan)]]
        ]);
    }

    private function getAmountFromPlan($paymentPlan)
    {
        return $paymentPlan->price;
    }

    private function getUserEmailOrLogin(stdClass $payment)
    {
        return $payment->Model->AccountId;
    }

    private function getPayment(stdClass $payment)
    {
        return $payment->Model->Amount;
    }
}
