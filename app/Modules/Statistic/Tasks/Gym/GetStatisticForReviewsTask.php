<?php

namespace App\Modules\Statistic\Tasks\Gym;

use App\Modules\GymClass\Repositories\ClassScheduleDescriptionRepository;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereMonthCriteria;
use App\Ship\Criterias\Eloquent\WhereYearIsCriteria;
use App\Ship\Services\ConverterDateHelperService;

class GetStatisticForReviewsTask extends AbstractTask
{

    /**
     * @var ClassScheduleRepository
     */
    private $repository;
    /**
     * @var ConverterDateHelperService
     */
    private $converterDateHelperService;
    /**
     * @var ClassScheduleDescriptionRepository
     */
    private $classScheduleDescriptionRepository;

    public function __construct
    (
        ClassScheduleRepository $repository,
        ConverterDateHelperService $converterDateHelperService,
        ClassScheduleDescriptionRepository $classScheduleDescriptionRepository
    )
    {
        $this->repository = $repository;
        $this->converterDateHelperService = $converterDateHelperService;
        $this->classScheduleDescriptionRepository = $classScheduleDescriptionRepository;
    }

    public function run()
    {
        $ClassSchedulesIds = $this->repository->get('id')->toArray();

        $reviews = $this->classScheduleDescriptionRepository
            ->findWhereIn('class_schedule_id', $ClassSchedulesIds)
            ->count();

        return $reviews;
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

    public function whereYearIS(string $field, string $year)
    {
        $this->repository->pushCriteria(new WhereYearIsCriteria($field, $year));
    }
}
