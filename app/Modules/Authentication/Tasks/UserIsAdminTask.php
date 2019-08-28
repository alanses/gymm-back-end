<?php

namespace App\Modules\Authentication\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserIsAdminTask extends AbstractTask
{
    public function run(User $user)
    {
        if($user->user_type == User::$is_admin) {
            return true;
        }

        throw new AccessDeniedHttpException('This action allow only for admin');
    }
}
