<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'start_at' => $this->start_at->format('Y-m-d'),
            'is_paid' => (bool)$this->is_paid,
            'tags_count' => $this->whenCounted('tags'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'advertiser' => AdvertiserResource::make($this->whenLoaded('advertiser')),
            'created_at' => $this->whenNotNull($this->created_at?->format('Y-m-d'))
        ];
    }
}
