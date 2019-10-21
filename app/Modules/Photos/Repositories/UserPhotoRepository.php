<?php

namespace App\Modules\Photos\Repositories;

use App\Modules\Photos\Entities\UserPhoto;
use App\Ship\Abstraction\AbstractRepository;

class UserPhotoRepository extends AbstractRepository
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
        return UserPhoto::class;
    }
}
