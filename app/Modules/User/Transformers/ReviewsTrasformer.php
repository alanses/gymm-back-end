<?php

namespace App\Modules\User\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ReviewsTrasformer extends Resource
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
            'review_id' => $this->id,
            'description' => $this->description,
            'user_name' => $this->getUserName(),
            'user_email' => $this->getUserEmail(),
        ];
    }

    private function getUserName()
    {
        return optional($this->user)->name;
    }

    private function getUserEmail()
    {
        return optional($this->user)->email;
    }
}
