<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class CourseDetailResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => (string) $this->id,
            'title' => $this->name,
            'thumbnail' => $this->thumbnail_url,
            'price' => (string) $this->price,
            'introduce' => $this->introduce,
            'students_count' => $this->students_count,
            'sections' => SectionResource::collection($this->sections),
            'topics' => TopicResource::collection($this->topics),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
