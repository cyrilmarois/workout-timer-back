<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Set extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'round' => $this->round,
            'timer' => Timer::collection($this->whenLoaded('timer'))
        ];
    }
}
