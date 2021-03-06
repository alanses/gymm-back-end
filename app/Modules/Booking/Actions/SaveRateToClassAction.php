<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Achievements\Tasks\RegisterAchievementSubTask;
use App\Modules\Booking\Http\Requests\SaveRateToClassRequest;
use App\Modules\Booking\Tasks\MakeVisitBookingTask;
use App\Modules\Booking\Tasks\SaveRatingToTrainerTask;
use App\Modules\Gym\Entities\RatingForTrainer;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SaveRateToClassAction extends AbstractAction
{
    public function run(SaveRateToClassRequest $saveRateToClassRequest)
    {
        $classSchedule = $this->call(GetClassScheduleTask::class, [], [
            ['findByField' => ['id', $saveRateToClassRequest->schedule_id]]
        ])->first();

        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->checkIfEventHasPassed($classSchedule);

        $this->call(SaveRatingToTrainerTask::class, [
            $this->getDataForSaveTrainerRating($user, $classSchedule, $saveRateToClassRequest)
        ]);

        $this->call(MakeVisitBookingTask::class, [$user, $saveRateToClassRequest->schedule_id]);

        $this->call(RegisterAchievementSubTask::class, [$classSchedule, $user]);

        return $classSchedule;
    }

    private function getDataForCreateClassScheduleDescription(User $user,ClassSchedule $classSchedule, Request $request)
    {
        return [
            'user_id' => $user->id,
            'description' => $request->description,
            'full_class_type_id' => $request->full_class_type_id,
            'class_schedule_id' =>  $classSchedule->id,
            'rating_value' => $request->rating_value,
        ];
    }

    private function getDataForSaveTrainerRating(User $user, ClassSchedule $classSchedule, Request $request)
    {
        return [
            'user_id' => $user->id,
            'trainer_id' => $classSchedule->trainer_id,
            'rating_value' => $request->rating_value,
            'comment' => $request->description,
            'event_id' => $classSchedule->id,
            'published' => RatingForTrainer::$is_published
        ];
    }

    public function checkIfEventHasPassed(ClassSchedule $classSchedule)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $startDate = $classSchedule->start_date;

        if($currentDate < $startDate) {
            throw new AccessDeniedHttpException('Impossible to evaluate an event that has not yet occurred');
        }

        return true;
    }
}
