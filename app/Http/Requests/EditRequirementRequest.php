<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requirementCategory' => 'required',
            'requirement' => 'required',
            'quantity' => 'required | numeric | min:1',
            'type' => 'required',
            'status' => 'required',
            'is_active' => 'required',
        ];
    }
}
