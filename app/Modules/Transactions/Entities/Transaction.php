<?php

namespace App\Modules\Transactions\Entities;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends AbstractEntity
{
    protected $fillable = [
        'id',
        'user_id',
        'total',
        'points',
        'operation_type',
        'amount',
        'currency'
    ];

    public static $ADD_BONUS = 1;
    public static $REMOVE_BONUS = 0;

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
