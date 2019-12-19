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
            'image' => 'nullable|file|mimes:jpeg,bmp,png,svg'
        ];
    }

    public function messages()
    {
        return [
            'displayed_name.required' => 'Field Achievement name is required',
            'displayed_name.max' => 'Field Achievement name has max symbols 255',
            'image.file' => 'Field Image must by file',
            'image.mimes' => 'Field Image must by types: jpeg,bmp,png,svg',
            'kz_displayed_name.max' => 'Field Achievement kz name has max symbols 255',
            'ru_displayed_name.max' => 'Field Achievement ru name has max symbols 255'
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
