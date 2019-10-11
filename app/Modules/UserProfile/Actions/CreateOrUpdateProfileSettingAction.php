<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\User\Entities\User;
use App\Modules\UserProfile\Tasks\CreateOrUpdateProfileSettingTask;
use App\Ship\Abstraction\AbstractAction;
use App\Modules\UserProfile\Http\Requests\UserSettingsRequest;

class CreateOrUpdateProfileSettingAction extends AbstractAction
{
    public function run(UserSettingsRequest $request, User $user)
    {
        $settings = $this->getDataForCreateUserSettings($request, $user);
        $this->addUserId($settings, $user);

        return $this->call(CreateOrUpdateProfileSettingTask::class, [
            $settings
        ]);
    }

    private function addUserId(array &$settings, User $user) {
        $settings['user_id'] = $user->id;
    }

    private function getDataForCreateUserSettings(UserSettingsRequest $request, User $user)
    {
        return $request->only([
            'city_id',
            'spots',
            'level',
            'distance',
            'cretits_from',
            'cretits_to'
        ]);
    }
}
