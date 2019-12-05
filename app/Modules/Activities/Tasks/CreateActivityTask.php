<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Repositories\ActivityRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateActivityTask extends AbstractTask
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function run(array $attributes)
    {
        return $this->activityRepository->create($attributes);
    }
}
