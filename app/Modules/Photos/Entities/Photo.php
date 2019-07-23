<?php

namespace App\Modules\Photos\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Photo extends AbstractEntity
{
    protected $fillable = [
        'description',
        'file_name',
        'origin_name',
        'type'
    ];

    protected static $pathForGym = "Gym/Schedule/";

    public static function getBasePathForSchedule()
    {
        return static::$pathForGym;
    }
}
