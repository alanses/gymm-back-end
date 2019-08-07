<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Criterias\ThisLessOrGreaterColumnThatCriteria;
use App\Modules\GymClass\Entities\RecurringPattern;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\BetweenCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereInCriteria;

class GetListClassSchedulesTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $classScheduleRepository;

    public function __construct(ClassScheduleRepository $classScheduleRepository)
    {
        $this->classScheduleRepository = $classScheduleRepository;
    }

    public function run($dayOfMouth, $dayOfWeek)
    {
        return $this->classScheduleRepository
            ->whereHas('recurringPattern', function ($query) use ($dayOfMouth, $dayOfWeek) {
                return $query->where('recurring_type_id', '=', RecurringPattern::getDailyType())
                        ->orWhere('day_of_month', '=', $dayOfMouth)
                        ->orWhere('day_of_week', '=', $dayOfWeek);
            })
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

    public function whereLevelIs($value)
    {
        $this->classScheduleRepository->pushCriteria(new ThisEqualThatCriteria('level', $value));
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
}
