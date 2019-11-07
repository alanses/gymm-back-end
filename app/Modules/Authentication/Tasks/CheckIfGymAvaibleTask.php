<?php

namespace App\Modules\Authentication\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckIfGymAvaibleTask extends AbstractTask
{
    public function run(User $user)
    {
        if($this->checkIfUserGym($user) && $this->checkIfGymUnAvailable($user)) {
            throw new UnauthorizedHttpException('challenge', 'Gym are not available');
        }
    }

    private function checkIfUserGym(User $user) {
        return ($user->user_type == User::$is_gym) ? true : false;
    }

    private function checkIfGymUnAvailable(User $user)
    {
        if($gym = $user->gym) {
            if($gym->is_available == 0) {
                return true;
            }
        }

        return false;
    }
}
