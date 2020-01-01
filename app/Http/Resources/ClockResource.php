<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClockResource extends JsonResource
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
                'task_id' => $this->task_id,
                'clocked_out' => $this->clocked_out,
                'clocked_in' => $this->clocked_in
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
    }
}
