<?php

namespace App\Modules\Authentication\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;

class MakeLoginViaGoogleTask extends AbstractTask
{

    /**
     * @param string $token
     * @return User
     */

    public function run(string $token) :User
    {
        return Socialite::driver('Google')->userFromToken($token);
    }
}
