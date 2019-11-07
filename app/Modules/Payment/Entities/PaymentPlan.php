<?php

namespace App\Modules\Payment\Entities;

use App\Ship\Abstraction\AbstractEntity;

class PaymentPlan extends AbstractEntity
{
    protected $table = 'payments_plans';

    protected $fillable = [
        'name',
        'description',
        'count_credits',
        'price',
        'old_price',
        'discount'
    ];
}
