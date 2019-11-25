<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Tasks\GetCityTask;
use App\Ship\Abstraction\AbstractAction;

class GetCityAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(GetCityTask::class, [$id], [
            ['findByField' => ['id', $id]]
        ]);
    }
}
