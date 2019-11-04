<?php

namespace App\Modules\Transactions\Entities;

use App\Ship\Abstraction\AbstractEntity;

class SubscribeHistory extends AbstractEntity
{
    protected $table = 'subscribe_history';

    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'currency',
        'next_transaction_date',
        'description',
        'subscribe_id',
        'status'
    ];

    public static $IS_ACTIVE = 1;
    public static $IS_NOT_ACTIVE = 0;
}
