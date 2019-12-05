<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Activities\Tasks\DeleteActivityFileTask;
use App\Modules\Activities\Tasks\GetActivityTask;
use App\Modules\Activities\Tasks\UpdateActivityTask;
use App\Modules\Activities\Tasks\UploadImageTask;
use App\Modules\Admin\Http\Requests\ActivityRequest;
use App\Ship\Abstraction\AbstractAction;

class UpdateActivityAction extends AbstractAction
{
    private $fileName;

    public function __construct()
    {
        $this->fileName = null;
    }

    public function run(ActivityRequest $request)
    {
        $activity = $this->call(GetActivityTask::class, [], [
            ['findByField' => ['id', $request->id]]
        ]);

        if($file = $request->image) {
            $this->call(DeleteActivityFileTask::class, [$activity]);
            $this->fileName = $this->call(UploadImageTask::class, [$file, Activity::$PATH_FOR_IMAGE]);
        }

        $activity->update($this->getDateForUpdateActivity($request, $this->fileName));

        return $activity;
    }

    private function getDateForUpdateActivity(ActivityRequest $request, string $fileName = null)
    {
        $data = $request->only(['displayed_name', 'name']);

        if($fileName) {
            $data['image'] = $fileName;
        }

        return $data;
    }
}
