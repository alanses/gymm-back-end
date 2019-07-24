<?php

namespace App\Modules\GymClass\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class ClassScheduleRequest extends AbstractRequest
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
            'activities_id' => 'nullable|integer|exists:activities,id',
            'class_type_id' => 'nullable|integer|exists:class_types,id',
            'level' => 'nullable|integer',
            'credits' => 'nullable|integer',
            'booking_date' => 'nullable|date',
            'start_at' => 'nullable|date_format:H:i:s',
            'end_at' => 'nullable|date_format:H:i:s',
            'trainer_id' => 'required|integer|exists:trainers,id',
            'photo' => 'nullable|file',
            'repeat' => 'nullable|string|in:every_week,every_day,every_month'
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
