<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassTypeRepository;
use App\Ship\Abstraction\AbstractTask;

class GetClassTypesTask extends AbstractTask
{
    /**
     * @var ClassTypeRepository
     */
    private $repository;

    public function __construct(ClassTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->getDataForSelect(['id', 'name', 'displayed_name']);
    }
}
