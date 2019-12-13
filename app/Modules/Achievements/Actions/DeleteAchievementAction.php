<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\DeleteAchievementTask;
use App\Modules\Achievements\Tasks\DeleteAchivementFileTask;
use App\Modules\Achievements\Tasks\GetAchievementTask;
use App\Modules\Activities\Tasks\DeleteActivityTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteAchievementAction extends AbstractAction
{
    public function run($id)
    {
        $achievement = $this->call(GetAchievementTask::class, [], [
            ['findByField' => [$id]]
        ]);

        $this->call(DeleteAchivementFileTask::class, [$achievement]);
        $this->call(DeleteAchievementTask::class, [$achievement]);
    }
}
