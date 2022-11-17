<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileValidation extends FormRequest
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
     * Get the validation rules that apply to the request for fronted side.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'username' => 'required',
            'number'  =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' =>'required',
        ];
    }
}
