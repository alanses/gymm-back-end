<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\RecurringTypeRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetRepeatsTask extends AbstractTask
{

    /**
     * @var RecurringTypeRepository
     */
    private $repository;

    public function __construct(RecurringTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get($this->getSelectedFields());
    }

    public function getByField(string $fieldName, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}
