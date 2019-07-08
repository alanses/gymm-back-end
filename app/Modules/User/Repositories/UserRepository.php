<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractRepository;

class UserRepository extends AbstractRepository
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
    public function model()
    {
        return User::class;
    }
}
