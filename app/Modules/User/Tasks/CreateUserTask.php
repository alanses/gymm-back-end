<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;
use Prettus\Validator\Exceptions\ValidatorException;

class CreateUserTask extends AbstractTask
{
    protected $repository;

    /**
     * CreateUserTask constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param  array  $data
     * @return User
     * @throws ValidatorException
     */
    public function run(array $data)
    {
        /** @var User $user */
        return $this->repository->create($data);
    }
}
