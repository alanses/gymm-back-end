<?php

namespace App\Modules\Location\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class UpdateCityRequest extends AbstractRequest
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
            'displayed_name' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'displayed_name.required' => 'Field City name is required',
            'displayed_name.max' => 'Field City name has max symbols 255',
            'name.required' => 'Field City slag is required',
            'name.max' => 'Field City slag has max symbols 255',
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
