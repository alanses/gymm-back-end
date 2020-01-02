<?php

namespace App\Modules\SliderImages\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class SaveImagesForSliderRequest extends AbstractRequest
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
            'photos.*.description' => 'required|string|max:255',
            'photos.*.photo' => 'required|file|mimes:jpeg,bmp,png,svg'
        ];
    }

    public function messages()
    {
        return [
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
