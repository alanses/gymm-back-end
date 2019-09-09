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
