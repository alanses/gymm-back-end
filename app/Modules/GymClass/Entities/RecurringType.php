<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class RecurringType extends AbstractEntity
{
    protected $fillable = [
        'displayed_name',
        'recurring_type'
    ];
}
