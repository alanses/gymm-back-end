<?php

namespace App\Modules\Admin\Actions;

use App\Modules\GymClass\Tasks\GetReviewTask;
use App\Ship\Abstraction\AbstractAction;

class GetReviewAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(GetReviewTask::class, [], [
            ['findByField' => ['id', $id]]
        ]);
    }
}
