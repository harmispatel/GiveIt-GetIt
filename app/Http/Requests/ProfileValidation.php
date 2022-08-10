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
            'number'  =>'required|digits:10 ',
            'address' =>'required',
<<<<<<< HEAD
            'password' => 'required|min:6'
=======
            // 'password' => 'required|min:6',
>>>>>>> ff224b86ab7663ea2a6aaa1db730dfc25fc138f9
        ];
    }
}
