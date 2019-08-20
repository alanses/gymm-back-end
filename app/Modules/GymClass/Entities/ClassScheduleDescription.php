<?php

namespace App\Modules\GymClass\Entities;

use App\Modules\Gym\Entities\RatingForTrainer;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;

class ClassScheduleDescription extends AbstractEntity
{
    protected $table = 'class_schedule_description';

    protected $fillable = [
        'user_id',
        'class_schedule_id',
        'description',
        'full_class_type_id',
        'rating_value'
    ];

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
