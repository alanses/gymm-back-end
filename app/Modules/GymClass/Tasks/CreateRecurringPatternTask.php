<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Modules\GymClass\Repositories\RecurringPatternRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateRecurringPatternTask extends AbstractTask
{
    /**
     * @var RecurringPatternRepository
     */
    private $recurringPatternRepository;

    public function __construct(RecurringPatternRepository $recurringPatternRepository)
    {
        $this->recurringPatternRepository = $recurringPatternRepository;
    }

    public function run(ClassSchedule $classSchedule)
    {
        if($this->validateIfIsRecurring($classSchedule)) {
            return $this->createRecurringPatterns();
        }
    }

    private function validateIfIsRecurring(ClassSchedule $classSchedule)
    {
        return $classSchedule->is_recurring == "Y" ? true : false;
    }

    private function createRecurringPatterns()
    {
        $this->recurringPatternRepository->create([
        ]);
    }
}
