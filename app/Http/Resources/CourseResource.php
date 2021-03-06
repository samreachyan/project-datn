<?php

namespace App\Http\Resources;

use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
          'id' => (string) $this->id,
          'title' => $this->name,
          'introduce' => $this->introduce,
          'thumbnail' => $this->thumbnail_url,
          'price' => $this->price,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
          'students_count' => (string) $this->students_count,
          'instructor' => new InstructorResource(Account::find($this->instructor_id))
        ];
    }
}
