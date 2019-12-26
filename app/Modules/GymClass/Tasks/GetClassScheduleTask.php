<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Entities\RecurringPattern;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\BetweenCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Modules\Booking\Criterias\ThisLessOrGreaterColumnThatCriteria;
use App\Ship\Criterias\Eloquent\WhereInCriteria;

class GetClassScheduleTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $classScheduleRepository;

    public function __construct(ClassScheduleRepository $classScheduleRepository)
    {
        $this->classScheduleRepository = $classScheduleRepository;
    }

    public function run()
    {
        return $this->classScheduleRepository
            ->get();
    }

    public function whereGymIs($value)
    {
        $this->classScheduleRepository->pushCriteria(new ThisEqualThatCriteria('gym_id', $value));
    }

    public function whereActivitiesIs(array $activities)
    {
        $this->classScheduleRepository->pushCriteria(new WhereInCriteria('activities_id', $activities));
    }

    public function whereLevelIs($level)
    {
        if($level == 0) {
            $this->classScheduleRepository->pushCriteria(new WhereInCriteria('level', [1,2,3]));
        } else {
            $this->classScheduleRepository->pushCriteria(new ThisEqualThatCriteria('level', $level));
        }
    }

    public function wherePoints($from, $to)
    {
        $this->classScheduleRepository->pushCriteria(new BetweenCriteria('credits', $from, $to));
    }

    public function whereSpots($countSpots)
    {
        $this->classScheduleRepository
            ->pushCriteria(new ThisLessOrGreaterColumnThatCriteria($countSpots));
    }

    public function findByField($field, $value)
    {
        $this->classScheduleRepository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }

    public function withRelations()
    {
        $this->classScheduleRepository->with([
            'trainer',
            'activityType',
            'classScheduleDescription.user.userSetting.city',
            'reviews'
        ]);
    }
}
