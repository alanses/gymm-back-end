<?php

namespace App\Modules\Achievements\Entities;

use App\Ship\Abstraction\AbstractEntity;

class UserActivity extends AbstractEntity
{
    protected $table = 'user_activities';

    protected $fillable = [
        'user_id',
        'activity_id',
        'count_visiting',
    ];
}
