<?php

namespace App\Modules\Gym\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Gym extends AbstractEntity
{
    protected $fillable = [
        'user_id',
        'address',
        'available_from',
        'available_to',
        'lat',
        'lng'
    ];

    public function trainers()
    {
        return $this->hasMany(Trainer::class, 'gym_id', 'id');
    }
}
