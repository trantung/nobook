<?php

namespace App\Http\Requests\Classes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'code' => 'nullable|string|unique:classes,code,'.request()->id,
            'level' => 'required|numeric',
            'is_public' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'Mã lớp học là duy nhất!'
        ];
    }
}
