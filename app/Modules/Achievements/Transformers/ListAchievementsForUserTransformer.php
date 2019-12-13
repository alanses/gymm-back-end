<?php

namespace App\Modules\Achievements\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListAchievementsForUserTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        dd($this);
        return parent::toArray($request);
    }
}
