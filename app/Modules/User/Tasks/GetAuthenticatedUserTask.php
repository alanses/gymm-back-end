<?php

namespace App\Modules\User\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;

class GetAuthenticatedUserTask extends AbstractTask
{
    /**
     * @var Guard
     */
    private $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @return Authenticatable|null
     */
    public function run() :?Authenticatable
    {
        return $this->guard->user();
    }
}
