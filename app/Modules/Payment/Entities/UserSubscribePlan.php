<?php

namespace App\Modules\Payment\Entities;

use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractEntity;

class UserSubscribePlan extends AbstractEntity
{
    protected $fillable = [
        'user_id',
        'plan_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
