<?php

namespace App\Modules\Achievements\Http\Controllers;

use App\Modules\Achievements\Actions\GetListAchievementsForUserAction;
use App\Modules\Achievements\Actions\GetListUserAchivementAction;
use App\Modules\Achievements\Transformers\ListAchievementsForUserTransformer;
use App\Modules\Achievements\Transformers\ListUserAchivementsTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class AchievementsController extends ApiController
{
    public function getUserAchievements()
    {
        $achivements = $this->call(GetListUserAchivementAction::class);

        return new ListUserAchivementsTransformer($achivements);
    }

    public function getListAchievements(Request $request)
    {
        $achievements = $this->call(GetListAchievementsForUserAction::class, [$request]);

        return new ListAchievementsForUserTransformer($achievements);
    }
}
