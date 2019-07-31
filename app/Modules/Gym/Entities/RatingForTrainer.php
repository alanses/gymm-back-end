<?php

namespace App\Modules\Gym\Entities;

use App\Ship\Abstraction\AbstractEntity;

class RatingForTrainer extends AbstractEntity
{
    protected $fillable = [
        'trainer_id',
        'user_id',
        'rating_value',
        'comment'
    ];
}
