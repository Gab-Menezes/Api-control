<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiFormRequest extends FormRequest
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
            'api' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Required field: Name',
            'api.required' => 'Required field: Api',
            'type.required' => 'Required field: Type'
        ];
    }
}
