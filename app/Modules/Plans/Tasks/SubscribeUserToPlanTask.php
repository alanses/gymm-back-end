<?php

namespace App\Modules\Plans\Tasks;

use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserDetailRepository;
use App\Ship\Abstraction\AbstractTask;

class SubscribeUserToPlanTask extends AbstractTask
{
    private $userDetailRepository;

    public function __construct(UserDetailRepository $userDetailRepository)
    {
        $this->userDetailRepository = $userDetailRepository;
    }

    public function run(Plan $plan, User $user)
    {
        return $this->userDetailRepository->updateOrCreate([
            'user_id' => $user->id
        ], [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
        ]);
    }
}
