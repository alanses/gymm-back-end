<?php

namespace App\Modules\Statistic\Http\Controllers;

use App\Modules\Statistic\Actions\Gym\GetGymProfileStatisticSubAction;
use App\Modules\Statistic\Transformers\GymStatisticsTransformer;
use App\Ship\Parents\ApiController;

class GymStatisticController extends ApiController
{
    public function getProfileStatistic()
    {
        return $this->call(GetGymProfileStatisticSubAction::class);

        return new GymStatisticsTransformer(collect($statistic));
    }
}
