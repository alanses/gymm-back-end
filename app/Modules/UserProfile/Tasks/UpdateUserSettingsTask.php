<?php

namespace App\Modules\UserProfile\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class UpdateUserSettingsTask extends AbstractTask
{
    public function run(array $settings, User $user)
    {
        if($userSettings = $user->userSetting) {
            return $userSettings->update($settings);
        }
    }
}
