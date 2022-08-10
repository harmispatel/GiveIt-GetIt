<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordValidation extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
                
    
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password|min:6'
        

        ];
    }
}
