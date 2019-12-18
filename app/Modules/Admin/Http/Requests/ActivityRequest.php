<?php

namespace App\Modules\Admin\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class ActivityRequest extends AbstractRequest
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,bmp,png,svg',
            'kz_displayed_name' => 'nullable|string|max:255',
            'ru_displayed_name' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'displayed_name.required' => 'Field Activity name is required',
            'displayed_name.max' => 'Field Activity name has max symbols 255',
            'name.required' => 'Field Activity name is required',
            'name.max' => 'Field Activity name has max symbols 255',
            'image.file' => 'Field Image must by file',
            'image.mimes' => 'Field Image must by types: jpeg,bmp,png,svg',
            'kz_displayed_name.max' => 'Field Activity kz name has max symbols 255',
            'ru_displayed_name.max' => 'Field Activity ru name has max symbols 255'
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
