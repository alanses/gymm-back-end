<?php

namespace App\Modules\User\Tasks;

use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Modules\GymClass\Repositories\ClassScheduleDescriptionRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationCriteria;

class ListReviewsTask extends AbstractTask
{

    /**
     * @var ClassScheduleDescription
     */
    private $classScheduleDescription;

    public function __construct(ClassScheduleDescriptionRepository $repository)
    {
        $this->classScheduleDescription = $repository;
    }

    public function run()
    {
        return $this->classScheduleDescription
            ->get();
    }

    public function whereGymIS($id)
    {
        $this->classScheduleDescription->pushCriteria(new FindByRelationCriteria('classSchedule', 'gym_id', $id));
    }
}
