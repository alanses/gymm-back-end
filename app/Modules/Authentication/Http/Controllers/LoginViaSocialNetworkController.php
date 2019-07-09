<?php

namespace App\Modules\Authentication\Http\Controllers;

use App\Modules\Authentication\Actions\LoginViaFacebookAction;
use App\Modules\Authentication\Actions\LoginViaGoogleAction;
use App\Modules\Authentication\Actions\LoginViaInstagramAction;
use App\Modules\Authentication\Actions\LoginViaVkontakteAction;
use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\User\Transformers\UserTransformer;
use App\Ship\Parents\ApiController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class LoginViaSocialNetworkController extends ApiController
{
    public function loginViaFacebook(SocialiteRequest $request)
    {
        try {
            $user = $this->call(LoginViaFacebookAction::class, [$request]);

            return $this->transform($user, UserTransformer::class);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Invalid data for login');
        }
    }

    public function loginViaInstagram(SocialiteRequest $request)
    {
        try {
            $user = $this->call(LoginViaInstagramAction::class, [$request]);

            return $this->transform($user, UserTransformer::class);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Invalid data for login');
        }
    }

    public function loginViaVkontacte(SocialiteRequest $request)
    {
        try {
            $user = $this->call(LoginViaVkontakteAction::class, [$request]);

            return $this->transform($user, UserTransformer::class);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Invalid data for login');
        }
    }

    public function loginViaGoogle(SocialiteRequest $request)
    {
        try {
            $user = $this->call(LoginViaGoogleAction::class, [$request]);

            return $this->transform($user, UserTransformer::class);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Invalid data for login');
        }
    }
}
