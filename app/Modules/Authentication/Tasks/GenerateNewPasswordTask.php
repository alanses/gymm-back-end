<?php

namespace App\Modules\Authentication\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Str;

class GenerateNewPasswordTask extends AbstractTask
{
    public function run()
    {
        return Str::random(8);
    }
}
