<?php

namespace App\Modules\Transactions\Tasks;

use App\Modules\Plans\Entities\Plan;
use App\Modules\Transactions\Entities\Transaction;
use App\Modules\Transactions\Repositories\TransactionRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class RegisterTransactionTask extends AbstractTask
{
    /**
     * @var TransactionRepository
     */
    private $repository;
    protected $totalPoints;
    protected $operationType;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
        $this->totalPoints = 0;
    }

    public function run($plan, User $user)
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'operation_type' => $this->getOperationType(),
            'points' => $plan->count_credits,
            'total' => $this->getTotalPoints()
        ]);
    }

    private function getCurrentPointOfUser(User $user)
    {
        $lastTransaction = $user->transaction()->latest()->first();

        return !$lastTransaction ? 0 : $lastTransaction->total;
    }

    public function addPoints(User $user, $plan)
    {
        $currentPoints = $this->getCurrentPointOfUser($user);

        $this->totalPoints = $currentPoints + $plan->count_credits;
    }

    public function removePoint(User $user, Plan $plan)
    {
        $currentPoints = $this->getCurrentPointOfUser($user);

        $this->totalPoints = $currentPoints - $plan->count_credits;
    }

    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * @param string $operationType
     * @return int
     */
    public function setOperationType(string $operationType)
    {
        if($operationType == 'add') {
            $this->operationType = Transaction::$ADD_BONUS;
        } elseif ($operationType == 'remove') {
            $this->operationType = Transaction::$REMOVE_BONUS;
        } else {
            throw new \LogicException('Operation Type Not found');
        }
    }

    public function getOperationType()
    {
        return $this->operationType;
    }
}
