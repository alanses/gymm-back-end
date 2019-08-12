<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class ClassScheduleDescription extends AbstractEntity
{
    protected $table = 'class_schedule_description';

    protected $fillable = [
        'class_schedule_id',
        'description',
        'full_class_type_id'
    ];
}
