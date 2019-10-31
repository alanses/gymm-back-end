<?php

namespace App\Modules\Transactions\Tasks;

use App\Modules\Plans\Entities\Plan;
use App\Modules\Transactions\Repositories\SubscribeHistoryRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use stdClass;

class RegisterSubscribeToHistoryTask extends AbstractTask
{
    /**
     * @var SubscribeHistoryRepository
     */
    private $repository;

    public function __construct(SubscribeHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Plan $plan, User $user, stdClass $subscribe)
    {
        return $this->repository->create(
            [
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $this->getAmount($subscribe),
                'currency' => $this->getCurrency($subscribe),
                'next_transaction_date' => $this->getNextTransactionDate($subscribe),
                'description' => $this->getDescription($subscribe),
            ]
        );
    }

    private function getNextTransactionDate(stdClass $subscribe)
    {
        return $subscribe->Model->NextTransactionDateIso;
    }

    private function getCurrency(stdClass $subscribe)
    {
        return $subscribe->Model->Currency;
    }

    private function getAmount(stdClass $subscribe)
    {
        return $subscribe->Model->Amount;
    }

    private function getDescription(stdClass $subscribe)
    {
        return $subscribe->Model->Description;
    }
}
