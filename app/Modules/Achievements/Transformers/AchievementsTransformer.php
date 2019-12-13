<?php

namespace App\Modules\Achievements\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

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
            'ru_displayed_name' => $this->getTranslateDisplayedName('ru'),
            'kz_displayed_name' => $this->getTranslateDisplayedName('kz'),
            'count_classes' => $this->count_classes,
            'activity_id' => $this->activity_id,
            'activity_name' => $this->getActivityName(),
            'image' => $this->getImage(),
            'created_at' => $this->getCreatedAt(),
        ];
    }

    private function getCreatedAt()
    {
        return Carbon::parse()->format('Y-m-d');
    }

    private function getActivityName()
    {
        return optional($this->activity)->displayed_name;
    }

    private function getTranslateDisplayedName(string $lang)
    {
        if($this->hasTranslation('displayed_name', $lang)) {
            return $this->getTranslation('displayed_name', $lang);
        }
    }

    private function getImage()
    {
        if($image = $this->image) {
            return env('APP_URL') . Storage::url($image);
        }
    }
}
