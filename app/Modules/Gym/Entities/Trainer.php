<?php

namespace App\Modules\Gym\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Booking\Entities\BookingClass;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\Photos\Entities\TrainerPhoto;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasOne
     */
    public function photo() :HasOne
    {
        return $this->hasOne(TrainerPhoto::class, 'trainer_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function classSchedules() :HasMany
    {
        return $this->hasMany(ClassSchedule::class, 'trainer_id', 'id');
    }

    public function bookings()
    {
        return $this->hasManyThrough(BookingClass::class, ClassSchedule::class, 'trainer_id', 'event_id');
    }

    /**
     * @return integer|null
     */
    public static function getLastRecord()
    {
        return self::latest()
            ->first()
            ->id;
    }
}
