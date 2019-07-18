<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Http\Service\ClassDateSchedule;
use App\Ship\Abstraction\AbstractAction;

class CreateClassScheduleAction extends AbstractAction
{
    /**
     * @var ClassDateSchedule
     */
    private $classDateSchedule;

    public function __construct(ClassDateSchedule $classDateSchedule)
    {
        $this->classDateSchedule = $classDateSchedule;
    }

    public function run()
    {
        dd(
            $this->classDateSchedule->GetYeardays(, $dateend);
        );
    }
}
