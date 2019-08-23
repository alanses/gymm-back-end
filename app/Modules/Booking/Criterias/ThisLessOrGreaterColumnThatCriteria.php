<?php

namespace App\Modules\Booking\Criterias;

use App\Ship\Parents\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisEqualThatCriteria
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ThisLessOrGreaterColumnThatCriteria extends Criteria
{
    private $value;

    public function __construct($value)
    {
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
        return $model->whereRaw('class_schedules.count_persons <= class_schedules.max_count_persons ' . '-' . $this->value);
    }
}
