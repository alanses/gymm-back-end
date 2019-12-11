<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\GetAchievementTask;
use App\Ship\Abstraction\AbstractAction;

class GetAchievementAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(GetAchievementTask::class, [], [
            ['findByField' => [$id]]
        ]);
    }
}
