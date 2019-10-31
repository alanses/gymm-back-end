<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\CheckIfTransactionRejectedTask;
use App\Modules\Payment\Tasks\ConfirmPaymentTask;
use App\Modules\Payment\Tasks\MakeSubscribeTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;
use stdClass;

class ConfirmPaymentAction extends AbstractAction
{
    public function run(Request $request) :stdClass
    {
        $payment = $this->call(ConfirmPaymentTask::class, [$request]);

        $this->call(CheckIfTransactionRejectedTask::class, [$payment]);

        $subscribe = $this->call(MakeSubscribeTask::class, [$payment]);

        return $subscribe;
    }
}
