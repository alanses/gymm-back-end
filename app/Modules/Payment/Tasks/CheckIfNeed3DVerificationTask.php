<?php

namespace App\Modules\Payment\Tasks;

use App\Exceptions\Need3DVerificationException;
use App\Ship\Abstraction\AbstractTask;
use stdClass;

class CheckIfNeed3DVerificationTask extends AbstractTask
{
    public function run(stdClass $payment)
    {
        if($this->checkIfStatusRejected($payment) && $this->checkIfNeed3DVerification($payment)) {
            throw new Need3DVerificationException('Need 3D verification', $payment);
        }
    }

    private function checkIfStatusRejected(stdClass $payment)
    {
        return ($payment->Success == false) ? true : false;
    }

    private function checkIfNeed3DVerification(stdClass $payment)
    {
        if(property_exists($payment->Model, 'PaReq') && property_exists($payment->Model, 'AcsUrl')) {
            return true;
        }

        return false;
    }
}
