<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Tasks\CheckIfCityUsedTask;
use App\Modules\Location\Tasks\DeleteCityTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteCityAction extends AbstractAction
{
    public function run($id)
    {
        $this->call(CheckIfCityUsedTask::class, [$id]);

        return $this->call(DeleteCityTask::class, [$id]);
    }
}
