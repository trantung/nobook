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
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->getTypeName(),
            'desktop_avatar' => $this->getDesktopAvatar(),
            'mobile_avatar' => $this->getMobileAvatar(),
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
            'teachers' => TeacherResource::collection($this->whenLoaded('teachers')),
        ];
    }
}
