<?php

namespace App\Modules\Statistic\Http\Controllers;

use App\Modules\Statistic\Actions\GetStatisticForDayAction;
use App\Modules\Statistic\Actions\Gym\GetGymProfileStatisticSubAction;
use App\Modules\Statistic\Actions\Gym\GetStatisticForMouthAction;
use App\Modules\Statistic\Http\Requests\GetStatisticForDayRequest;
use App\Modules\Statistic\Http\Requests\GetStatisticForMonthRequest;
use App\Modules\Statistic\Transformers\GymStatisticsTransformer;
use App\Ship\Parents\ApiController;

class GymStatisticController extends ApiController
{
    public function getProfileStatistic()
    {
        $statistic = $this->call(GetGymProfileStatisticSubAction::class);

        return new GymStatisticsTransformer($statistic);
    }

    public function getStatisticForMonth(GetStatisticForMonthRequest $request)
    {
        $statistic = $this->call(GetStatisticForMouthAction::class, [$request->month_name]);

        return new GymStatisticsTransformer($statistic);
    }

    public function getStatisticForDay(GetStatisticForDayRequest $request)
    {
        $statistic = $this->call(GetStatisticForDayAction::class, [$request->month_name]);

        return new GymStatisticsTransformer($statistic);
    }
}
