<?php


namespace App\Ship\Abstraction;

use App\Modules\User\Entities\User;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\GeneratorTokenPassport;
use Tests\TestCase;

abstract class AbstractTestCase extends TestCase implements ParentInterface
{
    use GeneratorTokenPassport;

    /**
     * @return string
     */
    public function getTypeToken() :string
    {
        return 'Bearer';
    }

    public function getToken()
    {
        $user = User::getAdmin();

        $tokenData = $this->getBearerTokenByUser($user, '1', false);

        return $tokenData['token_type'] . ' ' . $tokenData['access_token'];
    }
}
