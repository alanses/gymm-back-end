<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetUserTask extends AbstractTask
{
    protected $repository;

    /**
     * GetAllUsersTask constructor.
     * @param  UserRepository  $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->repository->first();
    }

    /**
     * @param string $fieldName
     * @param $value
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getByField(string $fieldName, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}
