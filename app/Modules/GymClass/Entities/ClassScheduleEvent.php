<?php

namespace App\Modules\GymClass\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Modules\Gym\Entities\Gym;
use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassScheduleEvent extends AbstractEntity
{
    protected $table = "list_events";

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
        'count_persons',
        'max_count_persons',
        'gym_id',
        'recurring_type_id',
        'file_name',
        'origin_name',
        'description'
    ];

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
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

    public function recurringType()
    {
        return $this->belongsTo(RecurringType::class, 'recurring_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function trainer() :BelongsTo
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function gym() :BelongsTo
    {
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function classScheduleDescription() :HasMany
    {
        return $this->hasMany(ClassScheduleDescription::class, 'class_schedule_id', 'id');
    }

    public function classSchedule()
    {
        return $this->hasMany(ClassSchedule::class, 'class_schedule_event_id', 'id');
    }

    public function reviews()
    {
        return $this->hasManyThrough(ClassScheduleDescription::class, ClassSchedule::class);
    }
}
