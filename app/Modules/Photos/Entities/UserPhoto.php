<?php

namespace App\Modules\Photos\Entities;

use App\Ship\Abstraction\AbstractEntity;

class UserPhoto extends AbstractEntity
{
    protected $table = 'user_photos';

    protected $fillable = [
        'user_id',
        'file_name',
        'origin_name',
    ];

    protected static $pathForUserPhotos = "Gym/Users/Avatars/";

    public static function getBasePathForUserPhotos()
    {
        return static::$pathForUserPhotos;
    }
}
