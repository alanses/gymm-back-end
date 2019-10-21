<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class FindByRelationCriteria
 */
class FindByRelationTypeCriteria extends Criteria
{
    private $relation;
    private $column;
    private $value;
    private $type;

    /**
     * FindByRelationCriteria constructor.
     * @param $relation
     * @param $column
     * @param $value
     \*/
    public function __construct($relation, $column, $value, $type)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->value = $value;
        $this->type = $type;
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
            $query->where($this->column, $this->type, $this->value);
        });
    }
}
