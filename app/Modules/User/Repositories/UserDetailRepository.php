<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Entities\UserDetail;
use App\Ship\Abstraction\AbstractRepository;

class UserDetailRepository extends AbstractRepository
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
        return UserDetail::class;
    }
}
