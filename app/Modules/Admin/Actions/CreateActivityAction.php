<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Activities\Tasks\CreateActivityTask;
use App\Modules\Activities\Tasks\UploadImageTask;
use App\Modules\Admin\Http\Requests\ActivityRequest;
use App\Ship\Abstraction\AbstractAction;

class CreateActivityAction extends AbstractAction
{
    public function run(ActivityRequest $request)
    {
        if($file = $request->image) {
            $fileName = $this->call(UploadImageTask::class, [$file, Activity::$PATH_FOR_IMAGE]);
        }

        $activity = $this->call(CreateActivityTask::class, [$this->getDateForCreateActivity($request, $fileName)]);

        $this->syncLocalization($request, $activity);

        return $activity;
    }

    private function getDateForCreateActivity(ActivityRequest $request, ?string $fileName) :array
    {
        return [
            'name' => $request->name,
            'displayed_name' => $request->displayed_name,
            'image' => $fileName,
        ];
    }

    private function syncLocalization(ActivityRequest $request, Activity $activity)
    {
        $activity->setTranslation('displayed_name', 'ru', $request->ru_displayed_name);
        $activity->setTranslation('displayed_name', 'kz', $request->kz_displayed_name);
        $activity->save();
    }
}
