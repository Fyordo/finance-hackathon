<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'role' => $this->when($this->role_id, new RoleResource($this->role)),
            'gender' => $this->when($this->is_male, $this->is_male ? 'male' : 'female'),
            'dfa' => $this->dfa,
            'blocked' => $this->blocked,
        ];
    }
}
