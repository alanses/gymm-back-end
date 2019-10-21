<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\FilterByTimeTask;
use App\Modules\Booking\Tasks\GetPassedClassByUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetPassedClassByUserAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $bookings = $this->call(GetPassedClassByUserTask::class, [], [
            ['whereUserIs' => [$user]],
            ['whereIsNotVisited' => []],
            ['whereIsConfirm' => []],
            ['whereDateLessOrEqual' => []],
//            ['whereClassScheduleEndTimeLessThenCurrentTime' => []]
        ]);

        return $this->call(FilterByTimeTask::class, [$bookings]);
    }
}
