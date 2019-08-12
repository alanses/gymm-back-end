<?php

namespace App\Modules\GymClass\Entities;

use App\Ship\Abstraction\AbstractEntity;

class FullClassType extends AbstractEntity
{
    protected $table = 'full_class_types';

    protected $fillable = [
        'name',
        'displayed_name'
    ];
}
