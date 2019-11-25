<?php

namespace App\Modules\Location\Entities;


use App\Ship\Abstraction\AbstractEntity;

class Cities extends AbstractEntity
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'displayed_name',
        'country_id'
    ];
}
