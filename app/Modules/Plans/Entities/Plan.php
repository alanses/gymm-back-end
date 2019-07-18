<?php

namespace App\Modules\Plans\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Plan extends AbstractEntity
{
    protected $table = "plans";

    protected $fillable = [
        'name',
        'description',
        'count_credits',
        'payment_for_month'
    ];
}
