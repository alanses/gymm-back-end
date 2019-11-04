<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\GetListPaymentsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListPaymentsPlansAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListPaymentsTask::class);
    }
}
