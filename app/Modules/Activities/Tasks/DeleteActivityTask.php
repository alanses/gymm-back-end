<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractTask;

class DeleteActivityTask extends AbstractTask
{
    public function run(Activity $activity)
    {
        return $activity->delete();
    }
}
