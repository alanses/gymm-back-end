<?php

namespace App\Modules\Authentication\Tasks;

use App\Modules\Authentication\Services\PassportTokenService;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class GenerateTokenDataForUserTask extends AbstractTask
{
    /**
     * @var PassportTokenService
     */
    private $passportTokenService;

    /**
     * GenerateTokenDataForUserTask constructor.
     * @param PassportTokenService $passportTokenService
     */
    public function __construct(PassportTokenService $passportTokenService)
    {
        $this->passportTokenService = $passportTokenService;
    }

    /**
     * @param User $user
     * @return User
     */
    public function run(User $user) :User
    {
        $user['response_content'] = $this->passportTokenService->getBearerTokenByUser($user, '1', false);

        return $user;
    }
}
