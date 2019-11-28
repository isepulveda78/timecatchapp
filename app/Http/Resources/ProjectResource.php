<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
                'project' => $this->project,
                'notes' => $this->notes,
                'billable' => $this->billable,
                'date' => $this->date,
                'tasks' => $this->tasks
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
    }
}
