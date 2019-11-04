<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CheckIfUserHasSubscribeTask extends AbstractTask
{
    public function run(User $user)
    {
        if(!$user->userDetail) {
            throw new BadRequestHttpException('User haven\'t any subscribe');
        }
    }
}
