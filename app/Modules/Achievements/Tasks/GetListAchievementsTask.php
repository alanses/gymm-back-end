<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Repositories\AchievementRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisLikeThatCriteria;

class GetListAchievementsTask extends AbstractTask
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
        return $this->repository->paginate(15);
    }

    public function withActivities()
    {
        $this->repository->with(['activity']);
    }

    public function search(?string $value)
    {
        if($value) {
            $this->repository->pushCriteria(new ThisLikeThatCriteria('displayed_name', $value));
        }
    }
}
