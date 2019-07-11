<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Repositories\ActivityRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetActivitiesTask extends AbstractTask
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function run()
    {
        return $this->activityRepository->get();
    }

    /**
     * @param string $fieldName
     * @param string $fieldValue
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function getByField(string $fieldName, string $fieldValue)
    {
        $this->activityRepository->pushCriteria(new ThisEqualThatCriteria($fieldName, $fieldValue));
    }
}
