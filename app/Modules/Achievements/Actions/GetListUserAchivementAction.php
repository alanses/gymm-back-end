<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\GetUserAchivementTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetListUserAchivementAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $achivements = $this->call(GetUserAchivementTask::class, [$user]);

        return $achivements;
    }
}
