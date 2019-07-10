<?php

namespace App\Modules\Authentication\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class SocialiteRequest extends AbstractRequest
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
            'token' => 'string|required',
            'type' => 'string|required|in:user,gym,supper_admin'
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
