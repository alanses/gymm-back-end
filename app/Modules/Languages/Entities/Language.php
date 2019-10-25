<?php

namespace App\Modules\Languages\Entities;

use App\Ship\Abstraction\AbstractEntity;

class Language extends AbstractEntity
{
    protected $table = 'languages';

    protected $fillable = [
        'short_name',
        'disabled_name'
    ];
}
