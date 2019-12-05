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
            'displayed_name' => 'required|string',
            'name' => 'required|string',
            'image' => 'nullable|file'
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
