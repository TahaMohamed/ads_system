<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ads_count' => $this->whenCounted('ads'),
            'ads' => AdResource::collection($this->whenLoaded('ads')),
            'created_at' => $this->whenNotNull($this->created_at?->format('Y-m-d'))
        ];
    }
}
