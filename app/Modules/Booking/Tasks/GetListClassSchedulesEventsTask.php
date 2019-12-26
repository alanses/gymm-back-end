<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Criterias\ThisLessOrGreaterColumnThatCriteria;
use App\Modules\GymClass\Entities\RecurringPattern;
use App\Modules\GymClass\Repositories\ClassScheduleEventRepository;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\BetweenCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\ThisMoreOrLessThatCriteria;
use App\Ship\Criterias\Eloquent\WhereInCriteria;

class GetListClassSchedulesEventsTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $classScheduleRepository;

    public function __construct(ClassScheduleEventRepository $scheduleEvent)
    {
        $this->classScheduleRepository = $scheduleEvent;
    }

    public function run()
    {
        return $this->classScheduleRepository
            ->get();
    }

    public function whereStartDateMoreThen($value)
    {
        $this->classScheduleRepository->pushCriteria(new ThisMoreOrLessThatCriteria('start_date', '<=', $value));
    }

    public function whereDateRecurringPatternIs($dayOfMouth, $dayOfWeek)
    {
        $this->classScheduleRepository
            ->whereHas('recurringPattern', function ($query) use ($dayOfMouth, $dayOfWeek) {
                return $query->where('recurring_type_id', '=', RecurringPattern::getDailyType())
                    ->orWhere('day_of_month', '=', $dayOfMouth)
                    ->orWhere('day_of_week', '=', $dayOfWeek);
            });
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

    public function whereStartDateIs($value)
    {
        $this->classScheduleRepository->pushCriteria(
            new ThisEqualThatCriteria('start_date', $value)
        );
    }
}
