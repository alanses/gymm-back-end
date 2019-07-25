<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Photos\Entities\Photo;
use App\Ship\Parents\Resource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ClassSchedulesCollection extends Resource
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
            'class_name' => optional($this->activityType)->displayed_name,
            'type' => optional($this->classType)->name,
            'level' => $this->getLevelDescription(),
            'credits' => $this->credits,
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'lesson_time' => $this->getLessonTime(),
            'repeat' => $this->getRepeat(),
            'displayed_name' => $this->getTrainerName(),
            'photo' => $this->getPhoto()
        ];
    }

    private function getLessonTime()
    {
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_time);
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->end_time);

        return $start_time->diffInMinutes($end_time);
    }

    private function getLevelDescription()
    {
        if($this->level == 0) {
            return 'Easy';
        }

        if ($this->level == 1) {
            return 'Normal';
        }

        if($this->level == 2) {
            return 'Hard';
        }

        if($this->level == 3) {
            return 'Very hard';
        }

        return 'Auther';
    }

    private function getRepeat()
    {
        if($recurringPattern = $this->recurringPattern) {
            return $recurringPattern->recurringType->displayed_name;
        }
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }

    private function getPhoto()
    {
        if($this->photo) {
            return env('APP_URL') . Storage::url(Photo::getBasePathForSchedule() .  $this->photo->file_name);
        }
    }
}
