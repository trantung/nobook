<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'string|required',
            'type' => 'numeric|required',
            'classes' => 'required|array|min:1',
            'subjects' => 'required|array|min:1',
            'intro_link' => 'string|nullable',
            'lms_id' => 'numeric|required',
            'method' => 'string|required',
            'is_public' => 'nullable',
            'is_highlight' => 'nullable',
            'desktop_avatar' => 'nullable|mimes:jpeg,png,jpg',
            'mobile_avatar' => 'nullable|mimes:jpeg,png,jpg',
            'slug' => 'string|nullable',
            'description' => 'string|nullable',
            'result_content' => 'string|nullable',
            'object_content' => 'string|nullable',
            'video_include' => 'string|nullable',
            'article_include' => 'string|nullable',
            'access_include' => 'string|nullable',
            'certificate_include' => 'string|nullable',
            'teachers' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'desktop_avatar.mimes' => 'Ảnh đại diện không đúng định dạng',
            'mobile_avatar.mimes' => 'Ảnh đại diện không đúng định dạng',
        ];
    }
}
