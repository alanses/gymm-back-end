<?php

namespace App\Modules\Gym\Entities;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;

class RatingForTrainer extends AbstractEntity
{
    protected $fillable = [
        'trainer_id',
        'user_id',
        'rating_value',
        'comment',
        'event_id',
        'published'
    ];

    public static $is_published = 1;
    public static $is_not_published = 0;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function classSchedule()
    {
        return $this->hasOne(ClassSchedule::class, 'id', 'event_id');
    }
}
