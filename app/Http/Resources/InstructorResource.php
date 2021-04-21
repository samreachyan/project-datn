<?php

namespace App\Http\Resources;

use App\Models\Account;
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
        $account = Account::find($this->id);

        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $instructor->bio,
            'introduce' => $instructor->introduce,
            'avatar_url' => $this->avatar_url,
        ];
    }
}
