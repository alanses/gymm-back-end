<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class GymClass extends AbstractEntity
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
}
