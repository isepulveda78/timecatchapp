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
                'tasks' => $this->tasks,
                'total_hours' => $this->total_hours,
                'total_minutes' => $this->total_minutes,
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
    }
}
