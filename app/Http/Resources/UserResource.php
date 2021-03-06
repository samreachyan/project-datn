<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->name,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url,
            'active' => $this->is_verified == 1 ? "true" : "false",
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
