<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisEqualThatCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ThisLessOrGreaterColumnThatCriteria extends Criteria
{

    private $firstField;
    private $secondField;
    private $operator;

    /**
     * ThisLessOrGreaterColumnThatCriteria constructor.
     * @param $firstField
     * @param $secondField
     * @param $operator
     */
    public function __construct($firstField, $secondField, $operator)
    {
        $this->firstField = $firstField;
        $this->secondField = $secondField;
        $this->operator = $operator;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereColumn($this->firstField, $this->operator, $this->secondField);
    }
}
