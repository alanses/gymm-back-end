<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Facades\Hash;

class ChangePasswordForUserTask extends AbstractTask
{
    public function run(User $user, string $password)
    {
        $user->update([
            'password' => Hash::make($password)
        ]);
    }
}
