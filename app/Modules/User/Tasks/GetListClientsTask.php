<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetListClientsTask extends AbstractTask
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository
            ->get($this->getSelectedFields());
    }

    public function whereTypeIsUser()
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_type', User::$is_user));
    }
}
