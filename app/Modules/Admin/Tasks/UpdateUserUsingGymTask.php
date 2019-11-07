<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\Gym\Entities\Gym;
use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateUserUsingGymTask extends AbstractTask
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes, Gym $gym)
    {
        return $this->repository->update($attributes, $gym->user_id);
    }
}
