<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Transactions\Entities\SubscribeHistory;
use App\Ship\Abstraction\AbstractTask;

class ChangeSubscribeStatusTask extends AbstractTask
{
    public function run(?SubscribeHistory $history)
    {
        return $history->update(['status' => SubscribeHistory::$IS_NOT_ACTIVE]);
    }
}
