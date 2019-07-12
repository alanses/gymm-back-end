<?php

namespace App\Modules\UserProfile\Entities;

use App\Modules\Activities\Entities\Activity;
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
        'cretits_to'
    ];

    public function activities()
    {
        return $this->hasMany();
    }
}
