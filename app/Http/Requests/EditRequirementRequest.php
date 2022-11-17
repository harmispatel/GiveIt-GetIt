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
     * Get the validation rules that apply to the request for Admin side.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
            'requirement' => 'required',
            'quantity' => 'required | numeric | min:1',
            'type' => 'required',
            'status' => 'required',
        ];
    }
}
