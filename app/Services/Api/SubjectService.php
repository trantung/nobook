<?php

namespace App\Services\Api;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectService
{
    public function subjectList(Request $request)
    {
        $data = Subject::where('is_public', 1)->get();
        $res = [];
        foreach ($data as $value) {
            $res[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        return $res;
    }
}
