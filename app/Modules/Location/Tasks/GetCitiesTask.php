<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationUsingOperatorCriteria;
use App\Ship\Criterias\Eloquent\ThisLikeThatCriteria;

class GetCitiesTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $repository;

    public function __construct(CitiesRepository $repository)
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
            $this->repository
                ->pushCriteria(new ThisLikeThatCriteria('displayed_name', $value));
        }
    }
}
