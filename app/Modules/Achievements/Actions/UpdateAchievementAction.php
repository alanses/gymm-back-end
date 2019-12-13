<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Entities\Achievement;
use App\Modules\Achievements\Http\Requests\AchievementRequest;
use App\Modules\Achievements\Tasks\DeleteAchivementFileTask;
use App\Modules\Achievements\Tasks\GetAchievementTask;
use App\Modules\Activities\Entities\Activity;
use App\Modules\Activities\Tasks\UploadImageTask;
use App\Ship\Abstraction\AbstractAction;

class UpdateAchievementAction extends AbstractAction
{
    private $fileName;

    public function __construct()
    {
        $this->fileName = null;
    }

    public function run(AchievementRequest $request)
    {
        $achievement = $this->call(GetAchievementTask::class, [], [
            ['findByField' => [$request->id]]
        ]);

        if($file = $request->image) {
            $this->call(DeleteAchivementFileTask::class, [$achievement]);
            $this->fileName = $this->call(UploadImageTask::class, [$file, Achievement::$PATH_FOR_IMAGE]);
        }

        $achievement->update($this->getDateForUpdateActivity($request, $this->fileName));

        $this->syncLocalization($request, $achievement);

        return $achievement;
    }

    private function getDateForUpdateActivity(AchievementRequest $request, string $fileName = null)
    {
        $data = $request->only(['displayed_name', 'activity_id', 'count_classes']);

        if($fileName) {
            $data['image'] = $fileName;
        }

        return $data;
    }

    private function syncLocalization(AchievementRequest $request, Achievement $achievement)
    {
        $achievement->setTranslation('displayed_name', 'ru', $request->ru_displayed_name);
        $achievement->setTranslation('displayed_name', 'kz', $request->kz_displayed_name);
        $achievement->save();
    }
}
