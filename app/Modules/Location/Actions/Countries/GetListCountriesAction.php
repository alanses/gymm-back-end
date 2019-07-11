<?php

namespace App\Modules\Location\Actions\Countries;

use App\Modules\Location\Tasks\Countries\GetListCountriesForSelectTask;
use App\Ship\Abstraction\AbstractAction;

class GetListCountriesAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListCountriesForSelectTask::class);
    }
}
