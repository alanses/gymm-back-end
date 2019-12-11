<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Achievements\Actions\DeleteAchievementAction;
use App\Modules\Achievements\Actions\GetAchievementAction;
use App\Modules\Achievements\Actions\GetListAchievementsAction;
use App\Modules\Achievements\Actions\UpdateAchievementAction;
use App\Modules\Achievements\Http\Requests\AchievementRequest;
use App\Modules\Achievements\Transformers\AchievementsTransformer;
use App\Modules\Activities\Actions\GetListActivitiesForSelectAction;
use App\Modules\Activities\Transformers\ListActivitiesForSelectTrasformer;
use App\Modules\Admin\Actions\CreateAchievementAction;
use App\Ship\Parents\ApiController;

class AchievementController extends ApiController
{
    public function getListAchievement()
    {
        $achievements = $this->call(GetListAchievementsAction::class);

        return AchievementsTransformer::collection($achievements);
    }

    public function getDateForCreateAchievement()
    {
        $activities = $this->call(GetListActivitiesForSelectAction::class);

        return ListActivitiesForSelectTrasformer::collection($activities);
    }

    public function show($id)
    {
        $achievement = $this->call(GetAchievementAction::class, [$id]);

        return new AchievementsTransformer($achievement);
    }

    public function store(AchievementRequest $request)
    {
        $achievement = $this->call(CreateAchievementAction::class, [$request]);

        return new AchievementsTransformer($achievement);
    }

    public function update(AchievementRequest $request)
    {
        $achievement = $this->call(UpdateAchievementAction::class, [$request]);

        return new AchievementsTransformer($achievement);
    }

    public function delete($id)
    {
        $this->call(DeleteAchievementAction::class, [$id]);

        return $this->success();
    }
}
