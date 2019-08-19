<?php

namespace App\Modules\UserProfile\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use App\Modules\Photos\Entities\UserPhoto;
use Illuminate\Support\Facades\Storage;

class UserProfileImageTransformer extends Resource
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
            'user_id' => $this->user_id,
            'photo' => $this->getPhoto()
        ];
    }

    private function getPhoto()
    {
        return env('APP_URL') . Storage::url(UserPhoto::getBasePathForUserPhotos() .  $this->file_name);
    }
}
