<?php

declare(strict_types=1);


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Timer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'set' => Set::collection($this->whenLoaded('set')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
