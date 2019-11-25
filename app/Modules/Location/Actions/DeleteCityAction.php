<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Tasks\DeleteCityTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteCityAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(DeleteCityTask::class, [$id]);
    }
}
