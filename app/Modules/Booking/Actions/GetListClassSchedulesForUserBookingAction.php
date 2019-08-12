<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Activities\Tasks\GetActivitiesByUserTask;
use App\Modules\Booking\Http\Requests\GetClassScheduleUserRequest;
use App\Modules\Booking\Tasks\GetListClassSchedulesTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\UserProfile\Entities\UserSetting;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;

class GetListClassSchedulesForUserBookingAction extends AbstractAction
{
    /**
     * @var Carbon
     */
    private $carbon;
    protected $user;
    protected $userSetting;

    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
        $this->user = null;
        $this->userSetting = null;
    }

    public function run(GetClassScheduleUserRequest $request)
    {
        $this->user = $this->call(GetAuthenticatedUserTask::class);
        $this->userSetting = $this->getUserSetting($this->user);

        $dayOfMouth = $this->carbon->parse($request->booking_date)->format('d');
        $dayOfWeek = $this->carbon->parse($request->booking_date)->dayOfWeek;

        return $this->call(GetListClassSchedulesTask::class, [], [
            ['whereDateRecurringPatternIs' => [$dayOfMouth, $dayOfWeek]],
            ['whereActivitiesIs' => [$this->getActivitiesIds($this->user)]],
            ['whereLevelIs' => [$this->getUserLevel($this->userSetting)]],
            ['wherePoints' => [
                $this->getCretitsFrom($this->userSetting),
                $this->getCretitsTo($this->userSetting),
            ]],
            ['whereSpots' => [$this->getSpots($this->userSetting)]]
        ])
            ->load(['trainer.avgRating']);
    }

    private function getActivitiesIds(User $user) :array
    {
        $activities = $this->call(GetActivitiesByUserTask::class, [$user]);

        return $activities->map(function ($activity) {
            return $activity->id;
        })->toArray();
    }

    private function getUserSetting(User $user)
    {
        return $user->userSetting;
    }

    private function getUserLevel(UserSetting $userSetting) :?int
    {
        return $userSetting ? $userSetting->level : null;
    }

    private function getCretitsFrom(UserSetting $userSetting)
    {
        return $userSetting ? $userSetting->cretits_from : null;
    }

    private function getCretitsTo(UserSetting $userSetting)
    {
        return $userSetting ? $userSetting->cretits_to : null;
    }

    private function getSpots(UserSetting $userSetting)
    {
        return $userSetting->spots;
    }
}
