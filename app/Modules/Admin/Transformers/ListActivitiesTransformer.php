<?php

namespace App\Modules\Admin\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ListActivitiesTransformer extends Resource
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
            'displayed_name' => $this->displayed_name,
            'image' => $this->getImage(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }

    private function getImage()
    {
        if($image = $this->image) {
            return env('APP_URL') . Storage::url($image);
        }
    }
}
