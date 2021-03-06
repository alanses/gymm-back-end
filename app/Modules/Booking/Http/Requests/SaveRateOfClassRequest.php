<?php

namespace App\Modules\Booking\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class SaveRateOfClassRequest extends AbstractRequest
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
            'schedule_id' => 'required|exists:class_schedules,id',
            'full_class_type_id' => 'required|exists:full_class_types,id'
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
