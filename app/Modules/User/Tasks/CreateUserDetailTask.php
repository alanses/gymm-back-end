<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Repositories\UserDetailRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateUserDetailTask extends AbstractTask
{
    /**
     * @var UserDetailRepository
     */
    private $repository;

    public function __construct(UserDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}
