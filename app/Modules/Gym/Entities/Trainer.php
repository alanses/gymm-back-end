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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(RatingForTrainer::class, 'trainer_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder
     */

    public function avgRating()
    {
        return $this
            ->ratings()
            ->selectRaw('avg(rating_value) as aggregate, trainer_id, COUNT(rating_value) as count')
            ->groupBy('trainer_id');
    }

    public static function getLastRecord()
    {
        return self::latest()
            ->first()
            ->id;
    }
}
