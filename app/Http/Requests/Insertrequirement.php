<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Insertrequirement extends FormRequest
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
            'Type'  => 'required|not_in:-- Select Type --',
            'category' =>'required',
           'quantity'  => 'required|integer|min:1',
           'media'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
            
         'requirement' => 'required'
            
        ];
    }
}
