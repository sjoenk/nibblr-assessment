<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class DinnerResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'max_members' => $this->max_members,
            'guests' => UserResource::collection($this->guests),
            'host' => new UserResource($this->host),
            'start' => $this->start,
            'end' => $this->end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
