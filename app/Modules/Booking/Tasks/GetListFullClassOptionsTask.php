<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\GymClass\Repositories\FullClassTypeRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListFullClassOptionsTask extends AbstractTask
{
    /**
     * @var FullClassTypeRepository
     */
    private $repository;

    public function __construct(FullClassTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository
            ->get($this->getSelectedFields());
    }
}
