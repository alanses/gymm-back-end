<?php

namespace App\Modules\Achievements\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Achievement extends AbstractEntity
{
    protected $table = 'achivements';

    protected $fillable = [
        'displayed_name',
        'count_classes',
        'achivement_id'
    ];
}
