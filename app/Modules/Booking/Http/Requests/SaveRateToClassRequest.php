<?php

namespace App\Modules\Booking\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class SaveRateToClassRequest extends AbstractRequest
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
            'full_class_type_id' => 'nullable|exists:full_class_types,id',
            'rating_value' => 'nullable|in:1,2,3,4,5',
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
