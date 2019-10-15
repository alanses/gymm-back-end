<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\User\Entities\User;
use App\Modules\UserProfile\Http\Requests\UserSettingsRequest;
use App\Modules\UserProfile\Tasks\UpdateUserSettingsTask;
use App\Ship\Abstraction\AbstractAction;

class UpdateUserSettingsAction extends AbstractAction
{
    public function run(UserSettingsRequest $request, User $user)
    {
        return $this->call(UpdateUserSettingsTask::class, [$this->getDataForUpdateUserSettings($request), $user]);
    }

    private function getDataForUpdateUserSettings(UserSettingsRequest $request)
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
