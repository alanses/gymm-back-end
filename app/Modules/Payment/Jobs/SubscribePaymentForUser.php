<?php

namespace App\Modules\Payment\Jobs;

use App\Modules\Payment\Service\CloudPaymentsService;
use App\Modules\Plans\Entities\Plan;
use App\Modules\Transactions\Entities\Transaction;
use App\Modules\Transactions\Repositories\TransactionRepository;
use App\Modules\User\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use stdClass;

class SubscribePaymentForUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Plan
     */
    private $plan;
    /**
     * @var stdClass
     */
    private $totalPoints;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $tries = 3;
    /**
     * @var stdClass
     */
    private $subscribe;

    public function __construct(User $user, Plan $plan, stdClass $subscribe)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->subscribe = $subscribe;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function handle(CloudPaymentsService $cloudPaymentsService)
    {
        if($this->checkIfUserSubscribeIsActive($cloudPaymentsService)) {

            $this->addPoints($this->user, $this->plan);

            $this->user->userTransactions()->create([
                'user_id' => $this->user->id,
                'operation_type' => 1,
                'points' => $this->plan->count_credits,
                'total' => $this->getTotalPoints()
            ]);
        }
    }

    private function checkIfUserSubscribeIsActive(CloudPaymentsService $cloudPaymentsService)
    {
        $subscribe = json_decode($cloudPaymentsService->infoAboutPayment($this->subscribe->Model->Id));

        return ($this->checkIfPaymentExist($subscribe) && $this->checkIfStatusActive($subscribe)) ? true : false;
    }

    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    public function addPoints(User $user, $plan)
    {
        $currentPoints = $this->getCurrentPointOfUser($user);

        $this->totalPoints = $currentPoints + $plan->count_credits;
    }

    private function getCurrentPointOfUser(User $user)
    {
        $lastTransaction = $user->transaction()->latest()->first();

        return !$lastTransaction ? 0 : $lastTransaction->total;
    }

    private function checkIfPaymentExist(stdClass $subscribe)
    {
        return $subscribe->Success != false ? true : false;
    }

    private function checkIfStatusActive(stdClass $subscribe)
    {
        return $subscribe->Model->Status == 'Active' ? true : false;
    }
}
