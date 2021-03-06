<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Repositories\AchievementRepository;
use App\Ship\Abstraction\AbstractTask;

class GetAchivementsForUserTask extends AbstractTask
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
        return $this->repository->get();
    }
}
