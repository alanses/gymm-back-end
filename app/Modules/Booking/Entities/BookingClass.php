<?php

namespace App\Modules\Booking\Entities;

use App\Modules\Activities\Entities\Activity;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingClass extends AbstractEntity
{
    protected $table = 'bookings_class';

    protected $fillable = [
        'event_id',
        'user_id',
        'confirm',
        'passed',
        'visited_by_user'
    ];

    public static $IS_CONFIRM = 1;
    public static $IS_NOT_CONFIRM = 0;

    public static $IS_NOT_VISITED = 0;
    public static $IS_VISITED = 1;

    /**
     * @return BelongsTo
     */

    public function classSchedule() :BelongsTo
    {
        return $this->belongsTo(ClassSchedule::class, 'event_id', 'id');
    }

    /**
     * @return BelongsTo
     */

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
