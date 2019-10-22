<?php

namespace App\Modules\Statistic\Tasks\Gym;

use App\Modules\Gym\Entities\RatingForTrainer;
use App\Modules\Gym\Repositories\RatingForTrainerRepository;
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
    private $ratingForTrainerRepository;

    public function __construct
    (
        ClassScheduleRepository $repository,
        ConverterDateHelperService $converterDateHelperService,
        RatingForTrainerRepository $ratingForTrainerRepository
    )
    {
        $this->repository = $repository;
        $this->converterDateHelperService = $converterDateHelperService;
        $this->ratingForTrainerRepository = $ratingForTrainerRepository;
    }

    public function run()
    {
        $ClassSchedulesIds = $this->repository->get('id')->toArray();

        $reviews = $this->ratingForTrainerRepository
            ->findWhereIn('event_id', $ClassSchedulesIds)
            ->count();

        return $reviews;
    }

    public function whereStartDateIs(string $field, string $numberOfMouth)
    {
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

    public function findByField($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
