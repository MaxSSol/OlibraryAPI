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
        parent::toArray($request);
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'status' => $this->banned ? 'Ban' : 'Active',
        ];
    }
}
