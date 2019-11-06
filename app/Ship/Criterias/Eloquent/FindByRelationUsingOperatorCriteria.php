<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class FindByRelationCriteria
 */
class FindByRelationUsingOperatorCriteria extends Criteria
{
    private $relation;
    private $column;
    private $value;
    private $operator;

    /**
     * FindByRelationCriteria constructor.
     * @param $relation
     * @param $column
     * @param $value
     \*/
    public function __construct($relation, $column, $value, $operator)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->value = $value;
        $this->operator = $operator;
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
        return $model->whereHas($this->relation, function ($query) {
            $query->where($this->column, $this->operator, $this->value);
        });
    }
}
