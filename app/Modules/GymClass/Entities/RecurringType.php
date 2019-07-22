<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class RecurringType extends AbstractEntity
{
    protected $fillable = [
        'displayed_name',
        'recurring_type'
    ];

    protected static $daily = 1;
    protected static $weekly = 2;
    protected static $monthly = 3;

    public function getRecurringTypes(string $type)
    {
        if($type == 'every_week') {
            return self::$weekly;
        }

        if($type == 'every_week') {
            return self::$weekly;
        }

        if($type == 'every_week') {
            return self::$weekly;
        }
    }
}
