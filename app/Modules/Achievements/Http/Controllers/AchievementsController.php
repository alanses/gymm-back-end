<?php

namespace App\Modules\Achievements\Http\Controllers;

use App\Modules\Achievements\Actions\GetListUserAchivementAction;
use App\Modules\Achievements\Transformers\ListUserAchivementsTransformer;
use App\Ship\Parents\ApiController;

class AchievementsController extends ApiController
{
    public function getUserAchievements()
    {
        $achivements = $this->call(GetListUserAchivementAction::class);

        return new ListUserAchivementsTransformer($achivements);
    }
}
