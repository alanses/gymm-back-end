<?php

namespace App\Modules\Languages\Actions;

use App\Modules\Languages\Tasks\GetListLanguagesTask;
use App\Ship\Abstraction\AbstractAction;

class GetListLanguagesAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListLanguagesTask::class);
    }
}
