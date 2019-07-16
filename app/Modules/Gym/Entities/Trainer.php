<?php

namespace App\Modules\Gym\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trainer extends AbstractEntity
{
    protected $fillable = [
        'gym_id',
        'trainer_name',
        'level',
        'cretits_from',
        'cretits_to',
    ];

    public function activities() :BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activities_trainers', 'trainer_id', 'activity_id');
    }

}
