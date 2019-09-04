<?php

namespace App\Modules\Gym\Entities;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Ship\Abstraction\AbstractEntity;

class Gym extends AbstractEntity
{
    protected $fillable = [
        'user_id',
        'address',
        'available_from',
        'available_to',
        'lat',
        'lng',
        'is_available'
    ];

    public static $IS_AVAILABLE = 1;
    public static $IS_NOT_AVAILABLE = 0;

    public function trainers()
    {
        return $this->hasMany(Trainer::class, 'gym_id', 'id');
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'gym_id', 'id');
    }

    public function classSchedulesDescription()
    {
        return $this->hasManyThrough(ClassScheduleDescription::class, ClassSchedule::class);
    }
}
