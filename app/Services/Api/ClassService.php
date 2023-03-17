<?php

namespace App\Services\Api;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassService
{
    public function classList(Request $request)
    {
        $data = ClassModel::where('is_public', 1)->get();
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
