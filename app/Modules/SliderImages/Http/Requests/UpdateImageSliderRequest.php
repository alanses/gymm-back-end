<?php

namespace App\Modules\SliderImages\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class UpdateImageSliderRequest extends AbstractRequest
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
            'image' => 'nullable|file|mimes:jpeg,bmp,png,svg',
            'description' => 'required|string'
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
