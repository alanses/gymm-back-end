<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Repositories\RecurringPatternRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateRecurringPatternSubTask extends AbstractTask
{
    /**
     * @var RecurringPatternRepository
     */
    private $recurringPatternRepository;

    public function __construct(RecurringPatternRepository $recurringPatternRepository)
    {
        $this->recurringPatternRepository = $recurringPatternRepository;
    }

    public function run(ClassSchedule $classSchedule, string $repeat)
    {
        if($this->validateIfIsRecurring($classSchedule)) {
            return $this->createRecurringPatterns($repeat);
        }
    }

    public function createRecurringPatterns(string $repeat)
    {
        return $this->call(CreateRecurringPatternTask::class, [], [
            [
                ''
            ]
        ]);
    }

    private function validateIfIsRecurring(ClassSchedule $classSchedule)
    {
        return $classSchedule->is_recurring == "Y" ? true : false;
    }
}
