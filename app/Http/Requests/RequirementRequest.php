<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
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
            'type' => 'required',
            'addsellPrice' => 'numeric|nullable',
            'addRentPrice' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'quantity'  => 'required|numeric|min:1|max:5000',
            'category' => 'required',
            'media'  => 'image|mimes:jpeg,png,jpg,gif,svg',
            'requirement' => 'required'
        ];
    }
}
