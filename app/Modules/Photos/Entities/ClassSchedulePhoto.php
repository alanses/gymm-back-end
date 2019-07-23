<?php

namespace App\Modules\Photos\Entities;

use App\Ship\Abstraction\AbstractEntity;

class ClassSchedulePhoto extends AbstractEntity
{
    protected $fillable = [
        'file_name',
        'origin_name',
        'class_schedule_id'
    ];
}
