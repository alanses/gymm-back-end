<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractAction;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CheckIfUserHasProfileSettingsAction extends AbstractAction
{
    public function run(User $user)
    {
        return $user->userSetting ? true : false;
    }
}
