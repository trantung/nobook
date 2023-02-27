<?php

namespace App\Http\Requests\Teachers;

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
            'label' => 'nullable|string',
            'avatar' => 'nullable|mimes:jpeg,png,jpg',
            'description' => 'nullable|string',
            'is_public' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' => 'Ảnh đại diện không đúng định dạng',
        ];
    }
}
