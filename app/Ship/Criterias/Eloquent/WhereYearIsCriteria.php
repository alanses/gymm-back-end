<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereYearIsCriteria extends Criteria
{

    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $year;

    /**
     * WhereInCriteria constructor.
     * @param string $field
     * @param string $year
     */
    public function __construct(string $field, string $year)
    {
        $this->field = $field;
        $this->year = $year;
    }

    /**
     * @param                                                   $model
     * @param PrettusRepositoryInterface $repository
     *
     * @return  mixed
     */

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereYear($this->field, $this->year);
    }
}
