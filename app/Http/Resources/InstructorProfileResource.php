<?php

namespace App\Http\Resources;

use App\Models\Account;
use App\Models\Instructor;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // point from instructor to account
        return [
            'id' => (string) $this->account->id,
            'name' => $this->account->name,
            'email' => $this->account->email,
            'bio' => $this->bio,
            'introduce' => $this->introduce,
            'avatar_url' => $this->account->avatar_url,
            'courses' => CourseResource::collection($this->course),
        ];
    }
}
