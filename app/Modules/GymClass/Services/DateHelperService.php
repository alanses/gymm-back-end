<?php
/**
 * Created by PhpStorm.
 * User: yaroslav
 * Date: 22.08.19
 * Time: 17:48
 */

namespace App\Modules\GymClass\Services;

use App\Ship\Abstraction\AbstractService;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class DateHelperService extends AbstractService
{
    public static $REQUIRING_TYPES = [
        1 => '1 day',
        2 => '1 week',
        3 => '1 months',
    ];

    public function generateListDates(Request $request)
    {
        $lastDateInThisYear = date('Y') . '-12-31';
        $todayDate = Carbon::parse($request->start_date)->format('Y-m-d');

        $start    = new DateTime($todayDate);
        $end      = new DateTime($lastDateInThisYear);

        $interval = DateInterval::createFromDateString($this->getPeriodType($request->repeat));
        $period   = new DatePeriod($start, $interval, $end);

        return $period;
    }

    public function getListDatesForSubscribe($start_date)
    {
        $lastDateInNextYear = date('Y', strtotime('+1 year')) . '-12-31';

        $todayDate = Carbon::parse($start_date)->format('Y-m-d');

        $start    = new DateTime($todayDate);
        $end      = new DateTime($lastDateInNextYear);

        $interval = DateInterval::createFromDateString($this->getPeriodType(3));
        $period   = new DatePeriod($start, $interval, $end);

        return $period;
    }

    protected function getPeriodType($requingTypes)
    {
        return self::$REQUIRING_TYPES[$requingTypes];
    }
}
