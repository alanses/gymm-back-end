<?php

namespace App\Modules\Booking\Entities;

use App\Ship\Abstraction\AbstractEntity;

class BookingClass extends AbstractEntity
{
    protected $fillable = [
        'event_id',
        'user_id'
    ];
}
