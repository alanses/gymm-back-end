<?php

namespace App\Modules\User\Entities;

use App\Modules\Plans\Entities\Plan;
use App\Modules\Transactions\Entities\Transaction;
use App\Ship\Abstraction\AbstractEntity;

class UserDetail extends AbstractEntity
{
    protected $table = 'user_detail';

    protected $fillable = [
        'user_id',
        'plan_id'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
