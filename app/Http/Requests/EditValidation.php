<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditValidation extends FormRequest
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
     * Get the validation rules that apply to the request for fronetend side.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required',
            'name' => 'required',
            'quantity'  => 'required|numeric|min:1|max:5000',
            'media'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'requirement' => 'required'

                ];
    }
}
