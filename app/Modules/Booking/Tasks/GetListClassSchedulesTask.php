<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\GymClass\Entities\RecurringPattern;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;

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
}
