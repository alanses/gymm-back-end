<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\UserProfile\Tasks\CreateOrUpdateProfileSettingTask;
use App\Ship\Abstraction\AbstractAction;
use App\Modules\UserProfile\Http\Requests\UserSettingsRequest;

class CreateOrUpdateProfileSettingAction extends AbstractAction
{
    public function run(UserSettingsRequest $request)
    {
        return $this->call(CreateOrUpdateProfileSettingTask::class, [
            $this->getDataForCreateUserSettings($request)
        ]);
    }

    private function getDataForCreateUserSettings(UserSettingsRequest $request)
    {
        return $request->only([
            'city_id',
            'user_id',
            'spots',
            'level',
            'distance',
            'cretits_from',
            'cretits_to'
        ]);
    }
}
