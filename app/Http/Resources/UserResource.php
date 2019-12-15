<?php

namespace App\Http\Resources;

use App\User;
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
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'location' => $this->location,
                'title' => $this->title,
                'education' => $this->education,
                'about' => $this->about,
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
}
}