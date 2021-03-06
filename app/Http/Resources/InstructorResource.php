<?php

namespace App\Http\Resources;

use App\Models\Instructor;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $instructor = Instructor::find($this->id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'bio' => $instructor->bio,
            'introduce' => $instructor->introduce
        ];
    }
}
