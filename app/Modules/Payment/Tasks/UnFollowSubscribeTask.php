<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Service\CloudPaymentsService;
use App\Ship\Abstraction\AbstractTask;

class UnFollowSubscribeTask extends AbstractTask
{
    /**
     * @var CloudPaymentsService
     */
    private $cloudPaymentsService;

    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }

    public function run(string $subID) :\stdClass
    {
        return json_decode($this->cloudPaymentsService->makeUnFollowForSubscribe($subID));
    }
}
