<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Criterias\WhereTimeByRelationCriteria;
use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationTypeCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use Illuminate\Support\Carbon;

class GetPassedClassByUserTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository
            ->get()
            ->load('classSchedule');
    }

    public function whereUserIs(User $user)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $user->id));
    }

    public function whereIsNotVisited()
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('passed', BookingClass::$IS_NOT_VISITED));
    }

    public function whereIsConfirm()
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('confirm', BookingClass::$IS_CONFIRM));
    }

    public function whereDateLessOrEqual()
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        $this->repository->pushCriteria(new FindByRelationTypeCriteria('classSchedule', 'start_date', $currentDate, '<='));
    }

    public function whereClassScheduleEndTimeLessThenCurrentTime()
    {
        $currentTime = Carbon::now()->format('H:i:s');

        $this->repository
            ->pushCriteria(new WhereTimeByRelationCriteria('classSchedule', 'end_time', $currentTime, '>='));
    }
}
