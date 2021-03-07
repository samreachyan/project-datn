<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'course_id' => (string) $this->id,
            'course_title' => $this->name,
            'course_thumnail' => $this->thumnail_url,
            'course_price' => (string) $this->price,
            'course_introduce' => $this->introduce,
        ];
    }
}
