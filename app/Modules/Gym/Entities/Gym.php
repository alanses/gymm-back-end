<?php

namespace App\Modules\Gym\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Gym extends AbstractEntity
{
    protected $fillable = [
        'user_id'
    ];
}
