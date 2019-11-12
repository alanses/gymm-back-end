<?php

namespace App\Modules\Achievements\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractEntity;

class UserActivity extends AbstractEntity
{
    protected $table = 'user_activities';

    protected $fillable = [
        'user_id',
        'activity_id',
        'count_visiting',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
