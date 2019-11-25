<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\Booking\Criterias\ThisLessOrGreaterColumnThatCriteria;
use App\Modules\GymClass\Criterias\ThisLessOrGreaterColumnThatInTableEventsCriteria;
use App\Modules\GymClass\Repositories\ClassScheduleEventRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\BetweenCriteria;
use App\Ship\Criterias\Eloquent\OrderByCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereInCriteria;

class GetListEventsTask extends AbstractTask
{
    /**
     * @var ClassScheduleEventRepository
     */
    private $repository;

    public function __construct(ClassScheduleEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get();
    }

    public function whereActivitiesIs(array $activities)
    {
        $this->repository->pushCriteria(new WhereInCriteria('activities_id', $activities));
    }

    public function whereLevelIs($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('level', $value));
    }

    public function wherePoints($from, $to)
    {
        $this->repository->pushCriteria(new BetweenCriteria('credits', $from, $to));
    }

    public function whereSpots($countSpots)
    {
        $this->repository
            ->pushCriteria(new ThisLessOrGreaterColumnThatInTableEventsCriteria($countSpots));
    }

    public function whereStartDateIs($value)
    {
        $this->repository->pushCriteria(
            new ThisEqualThatCriteria('start_date', $value)
        );
    }


    public function sortByTime()
    {
        $this->classScheduleRepository
            ->pushCriteria(new OrderByCriteria('start_time'));
    }
}
