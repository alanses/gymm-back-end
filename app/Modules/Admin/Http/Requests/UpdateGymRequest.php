<?php

namespace App\Modules\Admin\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class UpdateGymRequest extends AbstractRequest
{
    protected $urlParameters = [
        'id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:gyms,id',
            'email' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'web_site' => 'nullable|string',
            'phone' => 'nullable|string',
            'public_email' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Field Email is required',
            'email.max' => 'Field Email has max symbols 255',
            'name.required' => 'Field Gym name is required',
            'name.max' => 'Field Gym name has max symbols 255',
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
