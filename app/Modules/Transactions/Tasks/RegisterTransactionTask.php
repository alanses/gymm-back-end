<?php

namespace App\Modules\Transactions\Tasks;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\Plans\Entities\Plan;
use App\Modules\Transactions\Entities\Transaction;
use App\Modules\Transactions\Repositories\TransactionRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RegisterTransactionTask extends AbstractTask
{
    /**
     * @var TransactionRepository
     */
    private $repository;
    protected $totalPoints;
    protected $operationType;
    protected $countPoint;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
        $this->totalPoints = 0;
        $this->countPoint = 0;
    }

    public function run(User $user)
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'operation_type' => $this->getOperationType(),
            'points' => $this->getCountPoint(),
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

    public function removePoint(User $user)
    {
        $currentPoints = $this->getCurrentPointOfUser($user);

        $this->totalPoints = $currentPoints - $this->getCountPoint();

        if($this->totalPoints < 0) {
            throw new AccessDeniedHttpException('Not enough points for this operation');
        }
    }

    public function setPointsFromClassSchedule(BookingClass $bookingClass)
    {
        if($classSchedule = $bookingClass->classSchedule) {
            $this->countPoint = $classSchedule->credits;
        } else {
            $this->countPoint = 0;
        }
    }

    public function setPointsFromPlan($plan)
    {
        $this->countPoint = $plan->count_credits;
    }

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

    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    public function getOperationType()
    {
        return $this->operationType;
    }

    public function getCountPoint(): int
    {
        return $this->countPoint;
    }
}
