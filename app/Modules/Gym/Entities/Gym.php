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
        'lng'
    ];

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
