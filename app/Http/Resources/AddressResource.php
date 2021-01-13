<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'postal_code' => $this->postal_code,
            'number' => $this->number,
            'street' => $this->street,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
