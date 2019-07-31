<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\Trainers\FindTrainerTask;
use App\Ship\Abstraction\AbstractAction;

class FindTrainerByIdAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(FindTrainerTask::class, [], [
            [
                'getByField' => ['id', $id],
                'withRelations' => []
            ]
        ]);
    }
}
