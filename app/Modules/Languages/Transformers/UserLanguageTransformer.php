<?php

namespace App\Modules\Languages\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserLanguageTransformer extends Resource
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
            'language_id' => $this->language_id,
            'language_name' => $this->getLanguageName(),
            'short_name' => $this->getLanguageShortName()
        ];
    }

    private function getLanguageShortName()
    {
        return optional($this->language)->short_name;
    }

    private function getLanguageName()
    {
        return optional($this->language)->disabled_name;
    }
}
