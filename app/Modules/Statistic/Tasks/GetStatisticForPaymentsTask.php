<?php

namespace App\Modules\Statistic\Tasks;

use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Criterias\Eloquent\WhereMonthCriteria;
use App\Ship\Criterias\Eloquent\WhereYearIsCriteria;

class GetStatisticForPaymentsTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $payments = $this->repository->get();

        if($payments->isEmpty()) {
            return 0;
        }

        return $payments->load(['classSchedule'])->sum(function ($payment) {
            return $payment->classSchedule->credits;
        });
    }

    public function whereGymIS($value)
    {
        $this->repository->pushCriteria(new FindByRelationCriteria('classSchedule', 'gym_id', $value));
    }

    public function whereYearIS(string $field, string $year)
    {
        $this->repository->pushCriteria(new WhereYearIsCriteria($field, $year));
    }

    public function whereStartDateIs(string $field, string $numberOfMouth)
    {
        $this->repository->pushCriteria(new WhereMonthCriteria($field, $numberOfMouth));
    }

    public function findByField(string $field, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
