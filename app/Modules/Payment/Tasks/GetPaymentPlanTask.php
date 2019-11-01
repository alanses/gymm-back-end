<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Repositories\PaymentPlanRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetPaymentPlanTask extends AbstractTask
{
    /**
     * @var PaymentPlanRepository
     */
    private $repository;

    public function __construct(PaymentPlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByField(string $field, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
