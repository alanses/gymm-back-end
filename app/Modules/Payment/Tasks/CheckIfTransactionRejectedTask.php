<?php

namespace App\Modules\Payment\Tasks;

use App\Ship\Abstraction\AbstractTask;
use stdClass;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CheckIfTransactionRejectedTask extends AbstractTask
{
    public function run(stdClass $payment)
    {
        if($this->checkIfStatusRejected($payment) && $this->checkStatusDeclined($payment)) {
            throw new BadRequestHttpException($payment->Model->CardHolderMessage);
        }
    }

    private function checkIfStatusRejected(stdClass $payment)
    {
        return ($payment->Success == false) ? true : false;
    }

    private function checkStatusDeclined(stdClass $payment)
    {
        if(property_exists($payment->Model, 'Status')) {
            if($payment->Model->Status) {
                return true;
            }
        }

        return false;
    }
}
