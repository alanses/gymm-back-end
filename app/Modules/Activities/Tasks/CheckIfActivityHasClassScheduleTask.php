<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckIfActivityHasClassScheduleTask extends AbstractTask
{
    public function run(Activity $activity)
    {
        if($activity->classSchedules->isNotEmpty()) {
            throw new AccessDeniedHttpException('Activity has class schedules');
        }
    }
}
