<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Service\CloudPaymentsService;
use App\Ship\Abstraction\AbstractTask;
use stdClass;

class MakeSubscribeTask extends AbstractTask
{
    /**
     * @var CloudPaymentsService
     */
    private $cloudPaymentsService;

    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }

    public function run(stdClass $payment)
    {
        return json_decode($this->cloudPaymentsService->makeSubscribe(
            $payment
        ));
    }
}
