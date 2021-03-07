<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursePageResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [$this->count()];
        return [
            'prev_page_url' => $this->previousPageUrl(),
            'first_page' => '1',
            'current_page' => (string) $this->currentPage(),
            'last_page' => (string) $this->lastPage(),
            'next_page_url' => $this->nextPageUrl(),
            'total' => $this->total(),
            'per_page' => $this->perPage(),
            // 'path' => $this->path(),
            'courses' => CourseResource::collection($this->items()),
            'links' => $this->getOptions(),
        ];
    }
}
