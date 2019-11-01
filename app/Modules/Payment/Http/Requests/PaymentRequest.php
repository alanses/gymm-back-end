<?php

namespace App\Modules\Payment\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class PaymentRequest extends AbstractRequest
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
            'payment_plan_id' => 'required|exists:payments_plans,id',
            'CardCryptogramPacket' => 'required'
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
