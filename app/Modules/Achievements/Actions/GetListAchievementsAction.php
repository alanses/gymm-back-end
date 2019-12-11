<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\GetListAchievementsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListAchievementsAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListAchievementsTask::class);
    }
}
