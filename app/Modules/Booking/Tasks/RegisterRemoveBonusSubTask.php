<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Transactions\Tasks\RegisterTransactionTask;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class RegisterRemoveBonusSubTask extends AbstractTask
{
    public function run(BookingClass $bookingClass, User $user)
    {
        $this->call(RegisterTransactionTask::class, [$user], [
            ['setPointsFromClassSchedule' => [$bookingClass]],
            ['removePoint' => [$user]],
            ['setOperationType' => ['remove']]
        ]);
    }
}
