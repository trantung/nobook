<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseCmsResource extends JsonResource
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
            'lms_id' => $this->lms_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'sections' => CourseSectionResource::collection($this->whenLoaded('lmsSections')),
        ];
    }
}
