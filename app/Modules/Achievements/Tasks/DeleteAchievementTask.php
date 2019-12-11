<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Entities\Achievement;
use App\Ship\Abstraction\AbstractTask;

class DeleteAchievementTask extends AbstractTask
{
    public function run(Achievement $achievement)
    {
        return $achievement->delete();
    }
}
