<?php

namespace App\Modules\User\Transformers;

use App\Modules\Photos\Entities\UserPhoto;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ClientsTransformer extends Resource
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
            'image' => $this->getPhoto(),
        ];
    }

    private function getPhoto()
    {
        if($userPhoto = $this->userPhoto) {
            return env('APP_URL') . Storage::url(UserPhoto::getBasePathForUserPhotos() .  $userPhoto->file_name);
        }
    }
}
