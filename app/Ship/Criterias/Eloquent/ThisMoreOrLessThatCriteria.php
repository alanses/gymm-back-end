<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisEqualThatCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ThisMoreOrLessThatCriteria extends Criteria
{

    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $value;
    /**
     * @var
     */
    private $operator;

    /**
     * ThisEqualThatCriteria constructor.
     *
     * @param $field
     * @param $value
     */
    public function __construct($field, $operator, $value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where($this->field, $this->operator, $this->value);
    }
}
