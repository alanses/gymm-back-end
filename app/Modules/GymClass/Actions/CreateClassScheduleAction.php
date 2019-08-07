<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Tasks\CreateClassScheduleTask;
use App\Modules\GymClass\Tasks\CreateRecurringPatternTask;
use App\Modules\Photos\Tasks\UploadPhotoToClassScheduleTask;
use App\Modules\Photos\Entities\Photo;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class CreateClassScheduleAction extends AbstractAction
{
    public function run(ClassScheduleRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $classSchedule = $this->call(CreateClassScheduleTask::class, [
            $request,
            $gym
        ]);

        if($request->repeat) {
            $this->call(CreateRecurringPatternTask::class, [
                $classSchedule,
                $request,
            ]);
        }

        if($request->photo) {
            $this->call(UploadPhotoToClassScheduleTask::class, [
                $request->photo,
                $classSchedule,
                $user->id,
                Photo::getBasePathForSchedule()
            ]);
        }

        return $classSchedule;
    }
}
