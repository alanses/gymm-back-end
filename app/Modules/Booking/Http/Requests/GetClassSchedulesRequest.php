<?php

namespace App\Modules\Booking\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class GetClassSchedulesRequest extends AbstractRequest
{
    protected $urlParameters = [
        'booking_date'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'booking_date' => 'required|date'
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
