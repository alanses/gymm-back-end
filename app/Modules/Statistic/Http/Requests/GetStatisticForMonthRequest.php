<?php

namespace App\Modules\Statistic\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class GetStatisticForMonthRequest extends AbstractRequest
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
            'month_name' => 'required|string|in:January,February,March,April,May,June,July,August,September,October,November,December'
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
