<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetListGymsForAdminTask extends AbstractTask
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
        return $this->repository->paginate(10);
    }

    public function whereIsGym()
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_type', User::$is_gym));
    }

    public function withRelation()
    {
        $this->repository->with(['gym']);
    }
}
