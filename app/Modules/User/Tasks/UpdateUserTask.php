<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateUserTask extends AbstractTask
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }
}
