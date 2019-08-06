<?php

namespace App\Modules\Photos\Entities;

use App\Ship\Abstraction\AbstractEntity;

class TrainerPhoto extends AbstractEntity
{
    protected $table = 'trainer_photos';

    protected $fillable = [
        'trainer_id',
        'file_name',
        'origin_name',
    ];

    protected static $pathForTrainerPhotos = "Gym/Trainers/Avatars/";

    public static function getBasePathForTrainerPhotos()
    {
        return static::$pathForTrainerPhotos;
    }
}
