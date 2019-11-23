<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'clocked_in' => $this->clocked_in,
                'clocked_out' => $this->clocked_out,
                'friends' => $this->friends,
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
    }
}
