<?php

namespace App\Modules\Achievements\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class AchievementsTransformer extends Resource
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
            'displayed_name' => $this->displayed_name,
            'count_classes' => $this->count_classes,
            'achivement_id' => $this->achivement_id,
            'image' => $this->getImage(),
            'created_at' => $this->created_at,
        ];
    }

    private function getImage()
    {
        return $this->image;
    }
}
