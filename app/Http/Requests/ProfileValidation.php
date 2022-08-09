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
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request for fronted side.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'username' => 'required|max:8',
            // 'email' => 'required|email|unique:users,email,'.$user->id,
            'number'  =>'required|digits:10 ',
            'address' =>'required',
            'password' => 'required|min:6',
        ];
    }
}
