<?php

namespace App\Modules\GymClass\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class ClassesAttachedToGymRequest extends AbstractRequest
{
    protected $urlParameters = [
        'gym_id'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gym_id' => 'required|integer|exists:gyms,id',
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
