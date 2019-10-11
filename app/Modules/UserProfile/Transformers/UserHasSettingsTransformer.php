<?php

namespace App\Modules\UserProfile\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserHasSettingsTransformer extends Resource
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
            'user_has_profile' => $this->resource
        ];
    }
}
