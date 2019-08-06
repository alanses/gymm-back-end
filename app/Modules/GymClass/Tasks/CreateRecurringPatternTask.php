<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Entities\RecurringType;
use App\Modules\GymClass\Repositories\RecurringPatternRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Services\ReflectionApiService;
use App\Ship\Services\StringService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class   CreateRecurringPatternTask extends AbstractTask
{
    /**
     * @var StringService
     */

    private $stringService;

    /**
     * @var RecurringPatternRepository
     */

    private $recurringPatternRepository;

    /**
     * @var Carbon
     */
    private $carbon;

    public function __construct
    (
        StringService $stringService,
        RecurringPatternRepository $recurringPatternRepository,
        Carbon $carbon
    )
    {
        $this->stringService = $stringService;
        $this->recurringPatternRepository = $recurringPatternRepository;
        $this->carbon = $carbon;
    }

    public function run(ClassSchedule $classSchedule, Request $request)
    {
        $repeat = $this->call(GetRepeatsTask::class, [], [
                ['setSelectedFields' => [['id', 'displayed_name', 'recurring_type']]],
                ['getByField' => ['id', $request->repeat]]
        ])->first();

        $methodName = $this->stringService->convertStringForCallableMethod($repeat->recurring_type);

        return ReflectionApiService::initService()
            ->initReflectionMethod($this, $methodName)
            ->runWithArguments($classSchedule, $request->start_date);
    }


    private function everyWeek(ClassSchedule $classSchedule, string $startDate)
    {
        return $this->recurringPatternRepository->create([
            'class_schedule_id' => $classSchedule->id,
            'recurring_type_id' => RecurringType::$weekly,
            'day_of_week' => $this->carbon->parse($startDate)->dayOfWeek
        ]);
    }

    private function everyDay(ClassSchedule $classSchedule, string $startDate)
    {
        return $this->recurringPatternRepository->create([
            'class_schedule_id' => $classSchedule->id,
            'recurring_type_id' => RecurringType::$daily
        ]);
    }

    private function everyMonth(ClassSchedule $classSchedule, string $startDate)
    {
        return $this->recurringPatternRepository->create([
            'class_schedule_id' => $classSchedule->id,
            'recurring_type_id' => RecurringType::$monthly,
            'day_of_month' => $this->carbon->parse($startDate)->format('d')
        ]);
    }
}
