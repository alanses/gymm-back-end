<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class ClassScheduleDescription extends AbstractEntity
{
    protected $table = 'class_schedule_description';

    protected $fillable = [
        'user_id',
        'class_schedule_id',
        'description',
        'full_class_type_id'
    ];

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class, 'class_schedule_id', 'id');
    }
}
