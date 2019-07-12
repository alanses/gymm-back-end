<?php

namespace App\Modules\UserProfile\Repositories;

use App\Modules\UserProfile\Entities\UserSetting;
use App\Ship\Abstraction\AbstractRepository;

class UserSettingRepository extends AbstractRepository
{
    protected $fieldSearchable = [];

    /**
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
    public function boot()
    {

    }

    /**
    * @return string
    */
    function model()
    {
        return UserSetting::class;
    }
}
