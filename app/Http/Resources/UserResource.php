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
            'msg' => 'success',
            'data' => [
                'id' => $this->id,
                'username' => $this->username,
                'fulfname' => $this->name,
                'email' => $this->email,
                'active' => $this->is_verified == 1 ? "true" : "false",
                'token' => $this->remember_token,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
