<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class SetConnectionCriteria
 */
class SetConnectionCriteria extends Criteria
{
    private $connection;

    /**
     * SetConnectionCriteria constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->on($this->connection);
    }
}
