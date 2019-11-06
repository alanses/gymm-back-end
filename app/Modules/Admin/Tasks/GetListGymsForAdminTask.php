<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\Gym\Repositories\GymRepository;
use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationCriteria;
use App\Ship\Criterias\Eloquent\FindByRelationUsingOperatorCriteria;
use App\Ship\Criterias\Eloquent\FindOrByRelationCriteria;

class GetListGymsForAdminTask extends AbstractTask
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(GymRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate(10);
    }

    public function withRelation()
    {
        $this->repository->with(['user']);
    }

    public function search(?string $value)
    {
        if($value) {
            $value = '%' . $value . '%';
            $this->repository
                ->pushCriteria(new FindByRelationUsingOperatorCriteria('user', 'name', $value, 'like'));
        }
    }

    public function whereNameIs(?string $value)
    {
        if($value) {
            $this->repository->pushCriteria(new FindByRelationCriteria('user', 'email', $value));
        }
    }
}
