<?php

namespace App\Modules\Admin\Http\Requests;

use App\Ship\Abstraction\AbstractRequest;

class EmailToAdminRequest extends AbstractRequest
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
            'review_id' => 'required|integer|exists:rating_for_trainers,id'
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
