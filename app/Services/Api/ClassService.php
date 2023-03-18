<?php

namespace App\Services\Api;

use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassService
{
    public function classSubjectList(Request $request)
    {
        $dataClass = ClassModel::where('is_public', 1)->get();
        $dataSubject = Subject::where('is_public', 1)->get();
        $resClass = [];
        $resSubject = [];
        foreach ($dataClass as $value) {
            $resClass[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        foreach ($dataSubject as $value) {
            $resSubject[] = [
                'id' => $value->id,
                'name' => $value->name,
            ];
        }
        $res = [
            'class' => $resClass,
            'subject' => $resSubject
        ];
        return $res;
    }
}
