<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\Photos\Entities\UserPhoto;
use App\Modules\Photos\Tasks\UploadPhotoToUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\UserProfile\Http\Requests\SaveUserProfileImageRequest;
use App\Ship\Abstraction\AbstractAction;

class SaveUserProfileImageAction extends AbstractAction
{
    public function run(SaveUserProfileImageRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->call(UploadPhotoToUserTask::class, [
            $request->photo,
            $user,
            $user->id,
            UserPhoto::getBasePathForUserPhotos()
        ]);

        return $user->userPhoto;
    }
}
