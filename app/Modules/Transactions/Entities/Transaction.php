<?php

namespace App\Modules\Transactions\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Transaction extends AbstractEntity
{
    protected $fillable = [
        'id',
        'user_id',
        'total',
        'points',
        'operation_type'
    ];
}
