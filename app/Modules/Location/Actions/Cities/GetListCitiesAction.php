<?php

namespace App\Modules\Location\Actions\Cities;

use App\Modules\Location\Tasks\Cities\GetListCitiesForSelectTask;
use App\Ship\Abstraction\AbstractAction;

class GetListCitiesAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListCitiesForSelectTask::class);
    }
}
