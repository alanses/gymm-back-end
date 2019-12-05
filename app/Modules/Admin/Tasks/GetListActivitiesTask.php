<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\Activities\Repositories\ActivityRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisLikeThatCriteria;

class GetListActivitiesTask extends AbstractTask
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
        return $this->repository->paginate(10);
    }

    public function search(?string $value)
    {
        if($value) {
            $this->repository->pushCriteria(new ThisLikeThatCriteria('displayed_name', $value));
        }
    }
}
