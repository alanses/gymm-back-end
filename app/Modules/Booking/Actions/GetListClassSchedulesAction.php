<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\GetListClassSchedulesTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetListClassSchedulesAction extends AbstractAction
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
        $dayOfMouth = $this->carbon->parse($request->booking_date)->format('d');
        $dayOfWeek = $this->carbon->parse($request->booking_date)->dayOfWeek;

        return $this->call(GetListClassSchedulesTask::class, [$dayOfMouth, $dayOfWeek]);
    }
}
