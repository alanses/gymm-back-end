<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Repositories\AchievementRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetAchievementTask extends AbstractTask
{
    /**
     * @var AchievementRepository
     */
    private $repository;

    public function __construct(AchievementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByField($id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('id', $id));
    }
}
