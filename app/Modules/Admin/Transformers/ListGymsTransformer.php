<?php

namespace App\Modules\Admin\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ListGymsTransformer extends Resource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->getGymAddress(),
            'available_from' => $this->getGymAvailableFrom(),
            'available_to' => $this->getGymAvailableTo(),
            'is_available' => $this->getIsAvailable()
        ];
    }

    private function getGymAddress()
    {
        return optional($this->gym)->address;
    }

    public function getGymDescription()
    {
        return optional($this->gym)->description;
    }

    public function getGymAvailableFrom()
    {
        $available_from = optional($this->gym)->available_from;

        if($available_from) {
            return Carbon::parse($available_from)->format('H:i:s');
        }
    }

    public function getGymAvailableTo()
    {
        $available_from = optional($this->gym)->available_to;

        if($available_from) {
            return Carbon::parse($available_from)->format('H:i:s');
        }

    }

    public function getGymLat()
    {
        return optional($this->gym)->lat;
    }

    public function getGymLng()
    {
        return optional($this->gym)->lng;
    }

    public function getIsAvailable()
    {
        $is_available = optional($this->gym)->is_available;

        if(is_numeric($is_available)) {
            return boolval($is_available);
        }
    }
}
