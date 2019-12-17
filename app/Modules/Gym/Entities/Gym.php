<?php

namespace App\Modules\Gym\Entities;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Modules\User\Entities\User;
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
        'is_available',
        'description',
        'city_id'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasManyThrough(RatingForTrainer::class, Trainer::class);
    }
}
