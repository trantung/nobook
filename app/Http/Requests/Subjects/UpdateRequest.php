<?php

namespace App\Http\Requests\Subjects;

class UpdateRequest extends SubjectRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['code'] = 'nullable|string|unique:subjects,code,'. request()->id;

        return $rules;
    }
}
