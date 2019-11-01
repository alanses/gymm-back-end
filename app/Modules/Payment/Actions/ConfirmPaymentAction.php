<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\CheckIfTransactionRejectedTask;
use App\Modules\Payment\Tasks\ConfirmPaymentTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class ConfirmPaymentAction extends AbstractAction
{
    public function run(Request $request)
    {
        $payment = $this->call(ConfirmPaymentTask::class, [$request]);

        $this->call(CheckIfTransactionRejectedTask::class, [$payment]);

        return $payment;
    }
}
