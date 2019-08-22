<?php

namespace App\Modules\Statistic\Tasks\Gym;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereMonthCriteria;
use App\Ship\Services\ConverterDateHelperService;

class GetStatisticForClientsTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $repository;
    /**
     * @var ConverterDateHelperService
     */
    private $converterDateHelperService;

    public function __construct(ClassScheduleRepository $repository, ConverterDateHelperService $converterDateHelperService)
    {
        $this->repository = $repository;
        $this->converterDateHelperService = $converterDateHelperService;
    }

    public function run()
    {
        return (int)$this->repository->sum('count_persons');
    }

    public function whereStartDateIs(string $field, string $monthName)
    {
        $numberOfMouth = $this->converterDateHelperService->getMouthNumber($monthName);
        $this->repository->pushCriteria(new WhereMonthCriteria($field, $numberOfMouth));
    }

    public function whereGymIS($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('gym_id', $value));
    }
}
