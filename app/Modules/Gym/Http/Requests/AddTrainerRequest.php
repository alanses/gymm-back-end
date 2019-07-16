<?php

namespace App\Modules\Gym\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class AddTrainerRequest extends AbstractRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'trainer_name' => 'required|string',
            'level' => 'nullable|integer',
            'cretits_from' => 'nullable|integer',
            'cretits_to' => 'nullable|integer',
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
