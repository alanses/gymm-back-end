<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\AddPointsToAccountTask;
use App\Modules\Payment\Tasks\CheckIfTransactionRejectedTask;
use App\Modules\Payment\Tasks\ConfirmPaymentTask;
use App\Modules\Payment\Tasks\MakeSubscribeTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class ConfirmPaymentAction extends AbstractAction
{
    public function run(Request $request)
    {
        $payment = $this->call(ConfirmPaymentTask::class, [$request]);

        $this->call(CheckIfTransactionRejectedTask::class, [$payment]);

//        $this->call(AddPointsToAccountTask::class, [$plan, $user]);

        $subscribe = $this->call(MakeSubscribeTask::class, [$payment]);

        return $subscribe;
    }
}
