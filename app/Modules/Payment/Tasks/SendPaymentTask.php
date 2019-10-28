<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Service\CloudPaymentsService;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class SendPaymentTask extends AbstractTask
{
    /**
     * @var CloudPaymentsService
     */
    private $cloudPaymentsService;

    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }

    public function run($plan, $cryptID, $user)
    {
        return json_decode($this->cloudPaymentsService->makePaymentsCardsCharge($plan, $cryptID, $user));
    }

}
