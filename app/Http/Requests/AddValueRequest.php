<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddValueRequest extends FormRequest
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
            'attr_value' => 'required|unique:values,value'
        ];
    }

    public function messages()
    {
        return [
            'attr_value.required' => 'Giá trị thuộc tính không được để trống',
            'attr_value.unique' => 'Giá trị thuộc tính đã tồn tại',
        ];
    }
}
