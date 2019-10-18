<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Modules\GymClass\Repositories\ClassScheduleDescriptionRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateRateDescriptionOfClassTask extends AbstractTask
{
    /**
     * @var ClassScheduleDescription
     */
    private $classScheduleDescription;

    public function __construct(ClassScheduleDescriptionRepository $classScheduleDescription)
    {
        $this->classScheduleDescription = $classScheduleDescription;
    }

    public function run(array $attributes, $id)
    {
        return $this->classScheduleDescription->update($attributes, $id);
    }
}
