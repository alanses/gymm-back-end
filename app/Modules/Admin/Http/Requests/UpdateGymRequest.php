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
            'email' => 'required|string',
            'name' => 'required|string',
            'address' => 'nullable|string',
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Field Email is required',
            'name.required' => 'Field Gym name is required',
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
