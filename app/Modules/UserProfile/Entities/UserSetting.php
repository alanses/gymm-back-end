<?php

namespace App\Modules\UserProfile\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Location\Entities\Cities;
use App\Modules\Plans\Entities\Plan;
use App\Ship\Abstraction\AbstractEntity;

class UserSetting extends AbstractEntity
{
    protected $table = 'user_profile_settings';

    protected $fillable = [
        'user_id',
        'city_id',
        'spots',
        'level',
        'distance',
        'cretits_from',
        'cretits_to',
        'count_credits',
        'plan_id',
        'photo_id'
    ];

    public function userPlan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }
}
