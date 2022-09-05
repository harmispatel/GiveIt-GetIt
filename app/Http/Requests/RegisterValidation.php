<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidation extends FormRequest
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
            //
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'number'  =>'required|digits:10 ',
            'address' =>'required',
           
            'password'=>'required|min:6',
            'password_confirmation' =>'required_with:password|same:password|min:6'

        ];
    }
}
