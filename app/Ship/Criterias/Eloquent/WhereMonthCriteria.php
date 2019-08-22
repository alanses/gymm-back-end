<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisIdsCriteria
 *
 * @author Yaroslav Semeniv <yaroslav.semeniv@redentu.com>
 */

class WhereMonthCriteria extends Criteria
{

    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $monthNumber;

    /**
     * WhereInCriteria constructor.
     * @param string $field
     * @param int $monthNumber
     */
    public function __construct(string $field, int $monthNumber)
    {
        $this->field = $field;
        $this->monthNumber = $monthNumber;
    }

    /**
     * @param                                                   $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereMonth($this->field, $this->monthNumber);
    }
}
