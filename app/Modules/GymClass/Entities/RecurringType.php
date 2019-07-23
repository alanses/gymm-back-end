<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class RecurringType extends AbstractEntity
{
    protected $fillable = [
        'displayed_name',
        'recurring_type'
    ];

    public static $daily = 1;
    public static $weekly = 2;
    public static $monthly = 3;

    public function getRecurringTypes(string $type)
    {
        if($type == 'every_daily') {
            return static::$daily;
        }

        if($type == 'every_week') {
            return static::$weekly;
        }

        if($type == 'every_monthly') {
            return static::$monthly;
        }
    }
}
