<?php

namespace App\Modules\GymClass\Entities;

use App\Modules\Photos\Entities\Photo;
use App\Ship\Abstraction\AbstractEntity;
use Carbon\Carbon;

class ClassSchedule extends AbstractEntity
{
    protected $fillable = [
        'class_type_id',
        'activities_id',
        'level',
        'credits',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'is_full_day_event',
        'is_recurring',
        'trainer_id',
        'photo'
    ];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'model');
    }
}
