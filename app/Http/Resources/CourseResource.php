<?php

namespace App\Http\Resources;

use App\Models\CourseTeacher;
use App\Models\Teacher;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        // dd($request->id);
        $teacherData = [];
        $baseUrl = url('/') . '/';
        $teacherIds = CourseTeacher::where('course_id', $request->id)->pluck('teacher_id')->toArray();
        $teachers = Teacher::whereIn('id', $teacherIds)->get();
        foreach ($teachers as $key => $teacher) {
            $teacherData[$key]['id'] = $teacher->id;
            $teacherData[$key]['name'] = $teacher->name;
            $teacherData[$key]['label'] = $teacher->label;
            $teacherData[$key]['avatar'] = $baseUrl . $teacher->avatar;
            $teacherData[$key]['description'] = $teacher->description;
        }
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->getTypeName(),
            'desktop_avatar' => $baseUrl . $this->desktop_avatar,
            'mobile_avatar' => $baseUrl . $this->mobile_avatar,
            'intro_link' => $this->intro_link,
            'method' => $this->getMethodName(),
//            'is_public' => $this->is_public,
//            'is_highlight' => $this->is_highlight,
            'description' => $this->description,
            'detail' => $this->detail,
            'result_content' => $this->result_content,
            'object_content' => $this->object_content,
            'include_content' => $this->getIncludeContent(),
            'classes' => ClassResource::collection($this->whenLoaded('classes')),
            'sections' => CourseSectionResource::collection($this->whenLoaded('lmsSections')),
            'teachers' => $teacherData,
        ];
    }
}
