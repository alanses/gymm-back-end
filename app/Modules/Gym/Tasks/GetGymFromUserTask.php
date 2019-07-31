<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Entities\Gym;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GetGymFromUserTask extends AbstractTask
{
    public function run(User $user)
    {
        return $this->checkIfGymExist($user);
    }

    /**
     * @param User $user
     * @return Gym
     */

    private function checkIfGymExist(User $user) :Gym
    {
        if($gym = $user->gym){
            return $gym;
        }

        throw new AccessDeniedHttpException('permission denied for user');
    }
}
