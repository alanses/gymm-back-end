<?php

namespace App\Modules\Booking\Criterias;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class FindByRelationCriteria
 */
class WhereTimeByRelationCriteria extends Criteria
{
    private $relation;
    private $column;
    private $value;
    /**
     * @var string
     */
    private $type;

    /**
     * FindByRelationCriteria constructor.
     * @param $relation
     * @param $column
     * @param $value
     * @param string $type
     */
    public function __construct($relation, $column, $value, $type = '=')
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
            $query->whereTime($this->column, $this->type, $this->value);
        });
    }
}
