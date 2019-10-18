<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\UpdateRateDescriptionOfClassTask;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Modules\GymClass\Http\Requests\SaveRateDescriptionOfClassRequest;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveRateDescriptionAction extends AbstractAction
{
    public function run(SaveRateDescriptionOfClassRequest $request)
    {
//        return DB::transaction(function () use ($request) {

            $user = $this->call(GetAuthenticatedUserTask::class);

            $classScheduleDescription = $this->call(UpdateRateDescriptionOfClassTask::class, [
                $this->getDataForUpdateRateDescription($request),
                $request->id
            ]);

            $this->call(SetRatingToTrainerAction::class, [
                $this->getDataForSaveRatingForTrainer($request, $classScheduleDescription, $user)
            ]);
//        });
    }

    private function getDataForUpdateRateDescription(SaveRateDescriptionOfClassRequest $request)
    {
        return [
            'description' => $request->description,
            'rating_value' => $request->rating_value,
        ];
    }

    private function getDataForSaveRatingForTrainer
    (
        SaveRateDescriptionOfClassRequest $request,
        ClassScheduleDescription $classScheduleDescription,
        User $user
    )
    {
        return [
            'rating_value' => $request->rating_value,
            'comment' => $request->description,
            'user_id' => $user->id,
            'trainer_id' => optional($classScheduleDescription->classSchedule)->trainer_id
        ];
    }
}
