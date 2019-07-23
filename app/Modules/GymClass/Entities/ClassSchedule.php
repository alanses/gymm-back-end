<?php

namespace App\Modules\GymClass\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Gym\Entities\Trainer;
use App\Modules\Photos\Entities\ClassSchedulePhoto;
use App\Ship\Abstraction\AbstractEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassSchedule extends AbstractEntity
{
    protected $fillable = [
        'class_type_id',
        'activities_id',
        'level',
        'credits',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'is_full_day_event',
        'is_recurring',
        'trainer_id',
    ];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    /**
     * @return HasOne
     */
    public function photo() :HasOne
    {
        return $this->hasOne(ClassSchedulePhoto::class, 'class_schedule_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function activityType() :BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activities_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function classType() :BelongsTo
    {
        return $this->belongsTo(ClassType::class, 'class_type_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function recurringPattern() :HasOne
    {
        return $this->hasOne(RecurringPattern::class, 'class_schedule_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function trainer() :BelongsTo
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
