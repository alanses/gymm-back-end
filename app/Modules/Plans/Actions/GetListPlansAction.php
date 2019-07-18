<?php

namespace App\Modules\Plans\Actions;

use App\Modules\Plans\Tasks\GetListPlansTask;
use App\Ship\Abstraction\AbstractAction;

class GetListPlansAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListPlansTask::class, []);
    }
}
