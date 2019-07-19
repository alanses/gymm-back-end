<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class RecurringPattern extends AbstractEntity
{
    protected $fillable = [
        'class_schedule_id',
        'recurring_type_id',
        'day_of_week',
        'week_of_month',
        'day_of_month',
        'month_of_year',
    ];
}
