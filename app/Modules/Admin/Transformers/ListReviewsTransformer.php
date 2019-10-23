<?php

namespace App\Modules\Admin\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ListReviewsTransformer extends Resource
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
            'who' => $this->getUserName(),
            'when' => $this->getReviewCreateDate(),
            'comment' => $this->getComment(),
            'short_comment' => $this->getShortDescription(),
            'activity_name' => $this->getActivityName(),
            'address' => $this->getEventAddress()
        ];
    }

    private function getShortDescription()
    {
        if($this->comment) {
            $pieces = explode(" ", $this->comment);
            return implode(" ", array_splice($pieces, 0, 10));
        }
    }

    private function getUserName()
    {
        return optional($this->user)->name;
    }

    private function getReviewCreateDate()
    {
        return Carbon::parse($this->created_at)
            ->format('Y-m-d H:m');
    }

    private function getComment()
    {
        return $this->comment;
    }

    private function getActivityName()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->activityType)->displayed_name;
        }
    }

    private function getEventAddress()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->gym)->address;
        }
    }
}
