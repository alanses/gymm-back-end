<?php

namespace App\Modules\UserProfile\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class UserSettingsRequest extends AbstractRequest
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
            'city_id' => 'integer|nullable|exists:cities,id',
            'user_id' => 'integer|nullable|exists:users,id',
            'spots' => 'integer|nullable|in:1,2,3',
            'level' => 'integer|nullable|in:0,1,2,3,4',
            'distance' => 'integer|nullable|in:2,4,6',
            'cretits_from' => 'integer|nullable',
            'cretits_to' => 'required'
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
