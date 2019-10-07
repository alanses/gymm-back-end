<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Repositories\ClassScheduleEventRepository;
use App\Ship\Abstraction\AbstractAction;

class CreateClassScheduleEventAction extends AbstractAction
{

    /**
     * @var ClassScheduleEventRepository
     */
    private $classScheduleEventRepository;

    public function __construct(ClassScheduleEventRepository $classScheduleEventRepository)
    {
        $this->classScheduleEventRepository = $classScheduleEventRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run(array $data)
    {
        return $this
            ->classScheduleEventRepository
            ->create($data);
    }


}
