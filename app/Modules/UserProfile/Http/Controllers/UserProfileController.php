<?php

namespace App\Modules\UserProfile\Http\Controllers;

use App\Modules\Activities\Actions\AddActivitiesToUserAction;
use App\Modules\User\Actions\GetUserByIdAction;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\UserProfile\Actions\CreateOrUpdateProfileSettingAction;
use App\Modules\UserProfile\Actions\GetUserProfileAction;
use App\Modules\UserProfile\Actions\SaveUserProfileImageAction;
use App\Modules\UserProfile\Http\Requests\SaveUserProfileImageRequest;
use App\Modules\UserProfile\Http\Requests\UserSettingsRequest;
use App\Modules\UserProfile\Transformers\GetUserProfileTransformer;
use App\Modules\UserProfile\Transformers\GetUserSettingsTransformer;
use App\Modules\UserProfile\Transformers\UserProfileImageTransformer;
use App\Ship\Parents\ApiController;

class UserProfileController extends ApiController
{
    public function saveSettings(UserSettingsRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->call(CreateOrUpdateProfileSettingAction::class, [$request]);

        $this->call(AddActivitiesToUserAction::class, [$user, $request->activities]);

        return new GetUserSettingsTransformer($user);
    }

    public function getProfileSettingsByUserId()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        return new GetUserSettingsTransformer($user);
    }

    public function getProfile()
    {
        $userProfile = $this->call(GetUserProfileAction::class);

        return new GetUserProfileTransformer($userProfile);
    }

    public function saveUserProfileImage(SaveUserProfileImageRequest $request)
    {
        $userProfile = $this->call(SaveUserProfileImageAction::class, [$request]);

        return new UserProfileImageTransformer($userProfile);
    }
}
