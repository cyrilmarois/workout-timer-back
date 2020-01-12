<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sound extends JsonResource
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
            'name' => $this->name,
            'filename' => $this->filename,
            'round' => Round::collection($this->whenLoaded('round'))
        ];
    }
}
