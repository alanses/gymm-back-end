<?php

namespace App\Modules\Achievements\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListUserAchivementsTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'boxPercent' => $this->getBoxPercent(),
            'gymPercent' => $this->getGymPercent(),
            'yogaPercent' => $this->getYogaPercent(),
            'runPercent' => $this->getRunPercent(),
            'dancesPercent' => $this->getDancesPercent(),
            'cyclingPercent' => $this->getCyclingPercent(),
        ];
    }

    private function getBoxPercent()
    {
        $boxPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'boxing';
        })->first();

        return $boxPercent ? $boxPercent->count_visiting : 0;
    }

    private function getGymPercent()
    {
        $gymPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'gym_time';
        })->first();

        return $gymPercent ? $gymPercent->count_visiting : 0;
    }

    private function getYogaPercent()
    {
        $yogaPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'yoga';
        })->first();

        return $yogaPercent ? $yogaPercent->count_visiting : 0;
    }

    private function getRunPercent()
    {
        $runPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'running';
        })->first();

        return $runPercent ? $runPercent->count_visiting : 0;
    }

    private function getDancesPercent()
    {
        $dancesPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'dance';
        })->first();

        return $dancesPercent ? $dancesPercent->count_visiting : 0;
    }

    private function getCyclingPercent()
    {
        $cyclingPercent = $this->userActivity->filter(function ($userActivity, $key) {
            return $userActivity->activity->name == 'cicling';
        })->first();

        return $cyclingPercent ? $cyclingPercent->count_visiting : 0;
    }
}
