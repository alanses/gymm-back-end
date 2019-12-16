<?php

namespace App\Modules\Payment\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class PaymentCryptFormRequest extends AbstractRequest
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
            'payment_plan_id' => 'required|integer',
            'user_token' => 'required|string'
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
