<?php

namespace App\Modules\UserProfile\Http\Controllers;

use App\Modules\Activities\Actions\AddActivitiesToUserAction;
use App\Modules\User\Actions\GetUserByIdAction;
use App\Modules\UserProfile\Actions\CreateOrUpdateProfileSettingAction;
use App\Modules\UserProfile\Http\Requests\UserSettingsRequest;
use App\Modules\UserProfile\Transformers\GetUserSettingsTransformer;
use App\Ship\Parents\ApiController;

class UserProfileController extends ApiController
{
    public function saveSettings(UserSettingsRequest $request)
    {
        $user = $this->call(GetUserByIdAction::class, [$request->user_id]);

        $this->call(CreateOrUpdateProfileSettingAction::class, [$request]);

        $this->call(AddActivitiesToUserAction::class, [$user, $request->activities]);

        return new GetUserSettingsTransformer($user);
    }

    public function getProfileSettingsByUserId($id)
    {
        $user = $this->call(GetUserByIdAction::class, [$id]);

        return new GetUserSettingsTransformer($user);
    }
}
