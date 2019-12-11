<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Repositories\ActivityRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListActivitiesForSelectTask extends AbstractTask
{
    /**
     * @var ActivityRepository
     */
    private $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get($this->getSelectedFields());
    }
}
