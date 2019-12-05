<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractTask;

class UpdateActivityTask extends AbstractTask
{
    public function run(Activity $activity, array $attributes)
    {
        return $activity->update($attributes);
    }
}
