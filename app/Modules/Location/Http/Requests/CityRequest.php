<?php

namespace App\Modules\Location\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class CityRequest extends AbstractRequest
{
    protected $urlParameters = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'displayed_name' => 'required|string|max:255|unique:cities,displayed_name',
            'name' => 'nullable|string|max:255|unique:cities,name',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
