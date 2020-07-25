<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EndPointFormRequest extends FormRequest
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
            'name' => 'required',
            'end_point' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Required field: Name',
            'end_point.required' => 'Required field: End Point'
        ];
    }
}
