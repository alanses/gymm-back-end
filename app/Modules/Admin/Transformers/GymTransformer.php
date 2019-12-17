<?php

namespace App\Modules\Admin\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class GymTransformer extends Resource
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
            'name' => $this->getGymName(),
            'email' => $this->getGymEmail(),
            'address' => $this->getGymAddress(),
            'description' => $this->description,
            'available_from' => $this->getGymAvailableFrom(),
            'available_to' => $this->getGymAvailableTo(),
            'lat' => $this->lat,
            'lng' => $this->lng,
            'is_available' => $this->getIsAvailable(),
            'city_id' => $this->city_id
        ];
    }

    private function getGymName()
    {
        return optional($this->user)->name;
    }

    public function getGymEmail()
    {
        return optional($this->user)->email;
    }

    private function getGymAddress()
    {
        return $this->address;
    }

    public function getGymAvailableFrom()
    {
        $available_from = $this->available_from;

        if($available_from) {
            return Carbon::parse($available_from)->format('H:i');
        }

        return '';
    }

    public function getGymAvailableTo()
    {
        $available_from = $this->available_to;

        if($available_from) {
            return Carbon::parse($available_from)->format('H:i');
        }

        return '';
    }

    public function getIsAvailable()
    {
        if(is_numeric($this->is_available)) {
            return boolval($this->is_available);
        }
    }
}
