<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Repositories\PaymentPlanRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListPaymentsTask extends AbstractTask
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
        return $this->repository->get();
    }
}
