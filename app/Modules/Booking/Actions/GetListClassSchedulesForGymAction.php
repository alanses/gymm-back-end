<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\GetListClassSchedulesTask;
use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetListClassSchedulesForGymAction extends AbstractAction
{
    /**
     * @var Carbon
     */
    private $carbon;

    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    public function run(Request $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        return $this->call(GetListClassSchedulesTask::class, [], [
            ['whereGymIs' => [$gym->id]],
            ['whereStartDateIs' => [$request->booking_date]]
        ])
            ->load(['trainer', 'classType']);
    }
}
