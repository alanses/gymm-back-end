<?php

namespace App\Modules\Booking\Entities;

use App\Ship\Abstraction\AbstractEntity;

class BookingClass extends AbstractEntity
{
    protected $table = 'bookings_class';

    protected $fillable = [
        'event_id',
        'user_id'
    ];
}
