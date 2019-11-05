<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\GymClass\Services\DateHelperService;
use App\Modules\Payment\Jobs\SubscribePaymentForUser;
use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use stdClass;

class MakeSettingBonusToAccountTask extends AbstractTask
{
    /**
     * @var DateHelperService
     */
    private $dateHelperService;

    public function __construct(DateHelperService $dateHelperService)
    {
        $this->dateHelperService = $dateHelperService;
    }

    public function run(User $user, Plan $plan, stdClass $subscribe)
    {
        foreach ($this->dateHelperService->getListDatesForSubscribe($this->nextPayment($subscribe)) as $date) {
            SubscribePaymentForUser::dispatch($user, $plan, $subscribe)->delay($date);
        }
    }

    private function nextPayment(stdClass $subscribe)
    {
        return $subscribe->Model->NextTransactionDateIso;
    }
}
