<?php

namespace App\Modules\Authentication\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckIfOldPasswordValidTask extends AbstractTask
{
    /**
     * @var Hasher
     */
    private $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function run(User $user, string $oldPassword)
    {
        if(!$this->hasher->check($oldPassword, $user->password)) {
            throw new AccessDeniedHttpException('login or password is not currect');
        }

        return true;
    }
}
