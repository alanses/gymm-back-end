<?php

namespace App\Modules\Statistic\Tasks\Gym;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\CountCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereMonthCriteria;
use App\Ship\Criterias\Eloquent\WhereYearIsCriteria;
use App\Ship\Services\ConverterDateHelperService;

class GetStatisticForClassTask extends AbstractTask
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
        return $this->repository->count();
    }

    public function whereStartDateIs(string $field, string $numberOfMouth)
    {
        $this->repository->pushCriteria(new WhereMonthCriteria($field, $numberOfMouth));
    }

    public function whereGymIS($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('gym_id', $value));
    }

    public function findByField(string $field, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }

    public function whereYearIS(string $field, string $year)
    {
        $this->repository->pushCriteria(new WhereYearIsCriteria($field, $year));
    }
}
