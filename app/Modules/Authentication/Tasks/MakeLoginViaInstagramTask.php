<?php

namespace App\Modules\Authentication\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Facades\Socialite;

class MakeLoginViaInstagramTask extends AbstractTask
{
    /**
     * @param string $token
     * @return User
     */
    public function run(string $token) :User
    {
        return Socialite::driver('instagram')->userFromToken($token);
    }
}
