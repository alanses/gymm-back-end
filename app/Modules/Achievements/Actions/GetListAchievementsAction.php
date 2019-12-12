<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\GetListAchievementsTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetListAchievementsAction extends AbstractAction
{
    public function run(Request $request)
    {
        $achievements = $this->call(GetListAchievementsTask::class, [], [
            ['search' => [$request->search]],
            ['withActivities' => []]
        ]);

        return $achievements;
    }
}
