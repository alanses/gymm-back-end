<?php

namespace App\Modules\Booking\Http\Requests;

use App\Modules\Booking\Tasks\ClassBooking\GetClassBookingTask;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BookingRequest extends AbstractRequest
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
            'event_id' => [
                'required',
                'integer',
                'exists:class_schedules,id',
            ]
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
