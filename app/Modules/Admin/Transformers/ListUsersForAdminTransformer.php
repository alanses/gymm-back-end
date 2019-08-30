<?php

namespace App\Modules\Admin\Transformers;

use App\Modules\Photos\Entities\UserPhoto;
use App\Modules\User\Entities\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ListUsersForAdminTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->getUserType($this->user_type),
            'photo' => $this->getPhoto()
        ];
    }

    public function getUserType(string $type)
    {
        if($type == User::$is_user) {
            return 'User';
        }

        if($type == User::$is_gym) {
            return 'Gym';
        }
    }

    private function getPhoto()
    {
        if($userPhoto = $this->userPhoto) {
            return env('APP_URL') . Storage::url(UserPhoto::getBasePathForUserPhotos() .  $userPhoto->file_name);
        }
    }
}
