<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Achievements\Entities\Achievement;
use App\Modules\Achievements\Http\Requests\AchievementRequest;
use App\Modules\Achievements\Tasks\CreateAchievementTask;
use App\Modules\Activities\Entities\Activity;
use App\Modules\Activities\Tasks\UploadImageTask;
use App\Modules\Admin\Http\Requests\ActivityRequest;
use App\Ship\Abstraction\AbstractAction;

class CreateAchievementAction extends AbstractAction
{
    public function run(AchievementRequest $request)
    {
        if($file = $request->image) {
            $fileName = $this->call(UploadImageTask::class, [$file, Achievement::$PATH_FOR_IMAGE]);
        }

        $achievement = $this->call(CreateAchievementTask::class, [$this->getDateForCreateAchievement($request, $fileName)]);

        $this->syncLocalization($request, $achievement);

        return $achievement;
    }

    private function getDateForCreateAchievement(AchievementRequest $request, ?string $fileName) :array
    {
        return [
            'displayed_name' => $request->displayed_name,
            'count_classes' => $request->count_classes,
            'activity_id' => $request->activity_id,
            'image' => $fileName
        ];
    }

    private function syncLocalization(AchievementRequest $request, Achievement $achievement)
    {
        $achievement->setTranslation('displayed_name', 'ru', $request->ru_displayed_name);
        $achievement->setTranslation('displayed_name', 'kz', $request->kz_displayed_name);
        $achievement->save();
    }
}
