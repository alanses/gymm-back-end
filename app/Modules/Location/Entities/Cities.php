<?php

namespace App\Modules\Location\Entities;


use App\Modules\Gym\Entities\Gym;
use App\Modules\UserProfile\Entities\UserSetting;
use App\Ship\Abstraction\AbstractEntity;

class Cities extends AbstractEntity
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'displayed_name',
        'country_id'
    ];

    public function userSettings()
    {
        return $this->hasMany(UserSetting::class, 'city_id', 'id');
    }

    public function gyms()
    {
        return $this->hasMany(Gym::class, 'city_id', 'id');
    }
}
