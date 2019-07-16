<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\GymRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class FindGymTask extends AbstractTask
{

    /**
     * @var GymRepository
     */

    private $gymRepository;

    public function __construct(GymRepository $gymRepository)
    {
        $this->gymRepository = $gymRepository;
    }

    public function run()
    {
        return $this->gymRepository->first();
    }

    /**
     * @param string $fieldName
     * @param string $value
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function getByField(string $fieldName, string $value)
    {
        $this->gymRepository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}
