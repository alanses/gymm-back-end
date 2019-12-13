<?php

namespace App\Modules\Achievements\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class AchievementRequest extends AbstractRequest
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
            'id' => 'nullable|exists:achivements,id',
            'displayed_name' => 'required|string|max:255',
            'ru_displayed_name' => 'required|string|max:255',
            'kz_displayed_name' => 'required|string|max:255',
            'activity_id' => 'required|integer|exists:activities,id',
            'count_classes' => 'required|integer',
            'image' => 'nullable|file'
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
